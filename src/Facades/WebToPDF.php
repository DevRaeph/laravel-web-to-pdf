<?php
/*
 * ██████╗ ███████╗██╗   ██╗███████╗████████╗ ██████╗ ██████╗ ███╗   ███╗
 * ██╔══██╗██╔════╝██║   ██║██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗████╗ ████║
 * ██║  ██║█████╗  ██║   ██║███████╗   ██║   ██║   ██║██████╔╝██╔████╔██║
 * ██║  ██║██╔══╝  ╚██╗ ██╔╝╚════██║   ██║   ██║   ██║██╔══██╗██║╚██╔╝██║
 * ██████╔╝███████╗ ╚████╔╝ ███████║   ██║   ╚██████╔╝██║  ██║██║ ╚═╝ ██║
 * ╚═════╝ ╚══════╝  ╚═══╝  ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚═╝     ╚═╝
 * ______________________________________________________________________
 * | Author:    DevStorm Solutions - rplan
 * | Project:   ds-laravel-jwttoken-project
 * | File:      XToken.php
 * | Created:   06.02.2021
 * | Todo:
 * |_____________________________________________________________________
 */

namespace DevRaeph\WebToPdf\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * Class WebToPDF
 *
 * @mixin \DevRaeph\WebToPdf\WebToPDF
 *
 * @package DevRaeph\WebToPdf\Facades
 */
class WebToPDF extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'webtopdf';
    }
}
