<?php

namespace DevRaeph\WebToPdf;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
/**
 * UrlToPDF class
 * @author Raphael Planer aka DevRaeph
 * @version 1.1 Version
 * Test
 */

class WebToPDF
{
    private const APIURL = "https://pdf.devstorm.at/api/v1/";
    private const METHOD_GENERATE = "createPDF";

    private string $url;
    private string $fileName;
    private int $delay;
    private bool $fullPage;
    private string $storagePath;
    private string $content;

    function __construct()
    {
        $this->fileName = config('ds_webtopdf.fileName');
        $this->delay = config('ds_webtopdf.delay');
        $this->fullPage = config('ds_webtopdf.fullPage');
    }

    /**
     * @param string $url URL von der Website welche zu PDF konvertiert werden soll
     * @return WebToPDF
     */
    public function setUrl(string $url): WebToPDF
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $fileName Dateiname welcher gesetzt werden soll
     * @return WebToPDF
     */
    public function setFileName(string $fileName): WebToPDF
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @param int $delay Delay in Milisekunden
     * @return WebToPDF
     */
    public function setDelay(int $delay): WebToPDF
    {
        $this->deley = $delay;
        return $this;
    }

    /**
     * @param bool $fullPage True wenn die gesamte Seite konvertiert werden soll
     * @return WebToPDF
     */
    public function setFullPage(bool $fullPage): WebToPDF
    {
        $this->fullPage = $fullPage;
        return $this;
    }


    /**
     * DevStorm PDF-Generator
     * Output via {@link toFile()} or {@link toUrl()}
     * @return WebToPDF
     */
    public function generate():WebToPDF
    {
        $client = new Client();
        if($this->url == null || $this->url == ""){
            response([
                "message"=>"Es wurde keine URL mitgegeben!"
            ],400)->send();
            die();
        }
        try {
            $res = $client->request('POST',self::APIURL.self::METHOD_GENERATE,[
                    'headers' => ['X-DevStorm' => config('ds_webtopdf.apiToken')],
                    'query' => [
                        "url"=>$this->url,
                        "fileName"=>$this->fileName,
                        "delay"=>$this->delay,
                        "fullPage"=>$this->fullPage,
                        "force"=>config('ds_webtopdf.force'),
                    ]
            ]);
        }catch (ClientException $e){
            $message = json_decode($e->getResponse()->getBody(),true);
            $error = $message["message"];
            response([
                "message"=>$error
            ],400)->send();
            die();
        }

        if($res->getStatusCode() == 200 || $res->getStatusCode() == "200"){
            $myPDFArray = json_decode($res->getBody(),true);
            $fileName = $myPDFArray["data"]["filename"];
            $PDFContent = base64_decode($myPDFArray["data"]["content"]);
            $this->content = $PDFContent;
            Storage::put("pdf/".$fileName,$PDFContent);
            $this->storagePath = "pdf/".$fileName;
            //response()->download();
            return $this;
        }elseif($res->getStatusCode() === 400){
            response([
                "message"=>"Es ist ein Fehler aufgetreten!"
            ],400)->send();
            die();
        }else{
            response([
                "message"=>"Es ist ein Fehler aufgetreten!"
            ],400)->send();
            die();
        }
    }
    /**
     * DevStorm PDF-Generator
     * @return StreamedResponse Download wird gestreamt!
     */
    public function toFile():StreamedResponse{
        if($this->storagePath != null){
            return Storage::download($this->storagePath);
        }
    }
    /**
     * DevStorm PDF-Generator
     * @return string Rückegabe = URL
     */
    public function toUrl():string{
        if($this->storagePath != null){
            return env("APP_URL").Storage::url($this->storagePath);
        }
    }

}
