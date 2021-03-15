<?php
header("Content-type: text/css; charset: UTF-8");
echo cs_get_option('custom-css');


$mobile = cs_get_option('mobile_menu');

$min_mobile = isset($mobile) && $mobile ? '1025px' : '992px';
$max_mobile = isset($mobile) && $mobile ? '1024px' : '991px';

function hex2rgba($color, $opacity = false)
{

    $default = $color;

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

?>



.header_top_bg {
position: relative;
z-index: auto;
background-color: #ffffff;
}

.header_top_bg.fixed-header {
position: fixed;
top: 0;
width: 100%;
z-index: 100;
}

header {
position: relative;
width: 100%;
z-index: 999;
}

.only_logo header {
text-align: center;
}

header.absolute {
position: absolute;
margin-bottom: 0;
}

header a.logo {
text-decoration: none;
display: block;
}

header.zindex,
footer.zindex {
z-index: 1 !important;
}

.header_top_bg.enable_fixed.fixed {
position: fixed;
z-index: 1000;
width: 100%;
top: 0;
}

.header_trans-fixed.header_top_bg {
background-color: transparent;
position: fixed;
z-index: 1000;
top: 0;
width: 100%;
}

.header_trans-fixed.header_top_bg.open header .logo span,
.header_trans-fixed.header_top_bg.open header .mob-nav i {
color: #222222;
}

.header_underline.header_top_bg.menu_light_text {
border-bottom: 1px solid rgba(255, 255, 255, 0.18);
}

.single-post .header_trans-fixed.bg-fixed-color {
margin-left: 0;
width: 100%;
}

.top-menu {
padding-bottom: 10px;
}

.top-menu .logo {
display: inline-block;
}


.right-menu .logo span,
.only_logo .logo span {
vertical-align: middle;
text-align: left;
font-size: 30px;
line-height: 1.8;
font-weight: 800;
color: #222222;
}
.menu_light_text .right-menu .logo span {
color: #ffffff;
}
.right-menu #topmenu {
text-align: right;
}

.no-menu {
display: inline-block;
margin-top: 12px;
}

.header_top_bg.bg-fixed-color .top-menu .logo span,
.header_top_bg.bg-fixed-color .right-menu #topmenu ul li ul li a,
.menu_light_text .right-menu #topmenu ul li ul li a,
.socials-mob-but i,
.header_top_bg.bg-fixed-color .right-menu #topmenu ul li a,
.header_top_bg.bg-fixed-color.menu_light_text .right-menu #topmenu ul li a,
.header_top_bg.bg-fixed-color .right-menu #topmenu .search-icon-wrapper i,
.header_top_bg.bg-fixed-color.menu_light_text .right-menu #topmenu .search-icon-wrapper i,
.header_top_bg.bg-fixed-color .right-menu #topmenu .pixxy-shop-icon::before,
.header_top_bg.bg-fixed-color.menu_light_text .right-menu #topmenu .pixxy-shop-icon::before {
color: #222222;
}
.header_top_bg.bg-fixed-dark .top-menu .logo span,
.header_top_bg.bg-fixed-dark .right-menu #topmenu ul li a,
.header_top_bg.bg-fixed-dark.menu_light_text .right-menu #topmenu ul li a,
.header_top_bg.bg-fixed-dark .right-menu #topmenu .search-icon-wrapper i,
.header_top_bg.bg-fixed-dark.menu_light_text .right-menu #topmenu .search-icon-wrapper i,
.header_top_bg.bg-fixed-dark .right-menu #topmenu .pixxy-shop-icon::before,
.header_top_bg.bg-fixed-dark.menu_light_text .right-menu #topmenu .pixxy-shop-icon::before {
color: #ffffff;
}
.header_top_bg.bg-fixed-dark .right-menu #topmenu ul.sub-menu li a,
.header_top_bg.bg-fixed-dark.menu_light_text .right-menu #topmenu ul.sub-menu li a {
color: #222222;
}

#topmenu {
width: 100%;
text-align: center;
background: #ffffff;
}

#topmenu ul {
list-style: none;
margin: 0;
padding: 0;
display: inline-block;
font-family: 'Nunito Sans', sans-serif;
}

#topmenu ul li {
display: inline-block;
position: relative;
margin-left: 0;
}

@media (min-width: 992px) {
#topmenu ul li i {
display: none;
}
.main-wrapper {
padding-top: 0 !important;
}
}

#topmenu ul li a {
font-size: 15px;
font-weight: 600;
line-height: 2;
color: #222222;
display: block;
text-align: left;
text-decoration: none;
padding: 0 20px;
transition: all .3s ease;
-webkit-font-smoothing: antialiased;
}



.header_trans-fixed.header_top_bg.open #topmenu ul li a {
color: #222222;
}

.top-menu #topmenu > ul > li > a,
.top-menu #topmenu ul.social > li > a {
padding: 0;
}

#topmenu .social .fa {
font-size: 18px;
}

.top-menu .logo img {
max-height: 100px;
}

#topmenu ul ul {
position: absolute;
z-index: 999;
left: 0;
top: 50px;
min-width: 250px;
display: none;
box-sizing: border-box;
}

#topmenu ul ul li::before {
content: '';
display: table;
clear: both;
}

#topmenu ul ul li a {
padding: 3px 30px;
display: block;
width: 100%;
position: relative;
-webkit-font-smoothing: antialiased;
}

#topmenu > ul > li > ul > li:hover ul {
display: block;
}

#topmenu > ul > li > ul > li > ul {
left: 101%;
top: -15px;
}

.mob-nav {
display: none;
width: 22px;
height: 18px;
margin: 0 auto 12px;
font-size: 14px;
color: #222222;
opacity: 1;
}

.mob-nav:hover {
opacity: 0.7;
}

.right-menu .mob-nav .line {
width: 22px;
height: 3px;
background-color: #222222;
display: block;
float: left;
margin: 2px auto;
-webkit-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;
}

.right-menu .mob-nav .hamburger {
display: inline-block;
/*width: 20px;*/
}
.right-menu .mob-nav .hamburger i {
font-style: normal;
font-size: 12px;
font-weight: 600;
letter-spacing: 2px;
text-transform: uppercase;
}

.right-menu .mob-nav.active .line {
margin: 0;
background-color: #222222;
}
.right-menu .mob-nav.active .line:nth-of-type(2) {
opacity: 0;
}
.right-menu .mob-nav.active .line:nth-of-type(1) {
width: 28px;
-webkit-transform: translateY(4px) rotate(45deg);
-ms-transform: translateY(4px) rotate(45deg);
-o-transform: translateY(4px) rotate(45deg);
transform: translateY(4px) rotate(45deg);
}
.right-menu .mob-nav.active .line:nth-of-type(3) {
width: 28px;
-webkit-transform: translateY(-2px) translateX(-4px) rotate(-45deg);
-ms-transform: translateY(-2px) translateX(-4px) rotate(-45deg);
-o-transform: translateY(-2px) translateX(-4px) rotate(-45deg);
transform: translateY(-2px) translateX(-4px) rotate(-45deg);
}
.right-menu .mob-nav .line:nth-of-type(2) {
width: 22px;
}
.right-menu .mob-nav .line:nth-of-type(1) {
width: 18px;
}
.right-menu .mob-nav .line:nth-of-type(3) {
width: 18px;
margin-left: 4px;
}

header.simple {
display: flex;
justify-content: space-between;
align-items: center;
padding: 24px 50px;
}

header.simple .mob-nav {
display: block;
margin: 0;
position: relative;
z-index: 91;
transform: none;
top: 0;
left: 0;
}

/*------------------------------------------------------*/
/*---------------------- FULL SCREEN MENU ----------------------*/

.right-menu.full #topmenu-full .full-menu-wrap {
padding: 0 100px 30px;
text-align: left;
height: 100%;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
overflow-y: auto;
}

.right-menu.full #topmenu-full {
margin-top: 0;
position: fixed;
top: 0;
right: 0;
bottom: 0;
display: none;
transition: none;
width: 100%;
opacity: 1;
visibility: visible;
height: 100vh;
background: rgba(255, 255, 255, .95);
z-index: 90;
}
.right-menu.full #topmenu-full.open {
opacity: 1;
visibility: visible;
}
.header_top_bg .right-menu.full #topmenu-full ul li a {
color: #222222;
}
.header_top_bg .right-menu.full #topmenu-full ul li a:hover,
.header_top_bg .right-menu.full #topmenu-full ul .current-menu-parent > a,
.header_top_bg .right-menu.full #topmenu-full ul .current-menu-item > a {
color: #0073e6;
}
.right-menu.full #topmenu-full ul.menu li {
overflow: hidden;
}
.right-menu.full #topmenu-full ul.menu li a {
position: relative;
display: inline-block;
padding: 0;
text-decoration: none;
font-size: 40px;
font-weight: 900;
line-height: 1.35;
-webkit-transform: translateY(100%);
-ms-transform: translateY(100%);
transform: translateY(100%);
-webkit-transition: -webkit-transform 500ms cubic-bezier(0.510, -0.015, 0.860, 0.160);
transition: -webkit-transform 500ms cubic-bezier(0.510, -0.015, 0.860, 0.160);
-o-transition: transform 500ms cubic-bezier(0.510, -0.015, 0.860, 0.160);
transition: transform 500ms cubic-bezier(0.510, -0.015, 0.860, 0.160);
transition: transform 500ms cubic-bezier(0.510, -0.015, 0.860, 0.160), -webkit-transform 500ms cubic-bezier(0.510, -0.015, 0.860, 0.160);
}
.right-menu.full #topmenu-full.open ul.menu li a {
-webkit-transform: translateY(0);
-ms-transform: translateY(0);
transform: translateY(0);
}
.right-menu.full #topmenu-full ul.menu li .sub-menu {
display: none;
transition: none;
margin: 10px 0;
}

header.full #topmenu-full ul li.mega-menu:hover > ul {
padding-top: 10px;
}

.right-menu.full #topmenu-full ul ul li {
display: block !important;
float: none !important;
width: 100% !important;
}

.right-menu.full #topmenu-full ul li {
display: block;
}
.right-menu.full #topmenu-full .mob-nav {
position: relative;
z-index: 9000;
}
.right-menu.full #topmenu-full .menu {
text-align: center;
margin: auto;
}
.right-menu.full #topmenu-full .menu li {
margin-left: 0;
}
.right-menu.full #topmenu-full .sub-menu {
position: static !important;
-webkit-transform: none;
-moz-transform: none;
-ms-transform: none;
-o-transform: none;
transform: none;
}
.right-menu.full #topmenu-full ul ul {
display: block;
}
.right-menu.full #topmenu-full ul.menu ul li a {
display: inline-block;
width: auto;
font-size: 18px;
}
.right-menu.full #topmenu-full ul.menu .hide-drop {
display: none;
}

@media (max-width: 991px) {
header.simple {
padding: 15px 10px;
}

.search-icon-wrapper{
visibility: hidden;
-webkit-transition: all 500ms ease;
-moz-transition: all 500ms ease;
-ms-transition: all 500ms ease;
-o-transition: all 500ms ease;
transition: all 500ms ease;
}
.sidebar-open .search-icon-wrapper{
visibility: visible;
}

.right-menu.full #topmenu-full ul.menu li a {
font-size: 32px;
}
}

@media (max-width: 767px) {
.right-menu.full #topmenu-full ul.menu li a {
font-size: 27px;
}
}


@media only screen and (max-width: 991px) {
.header_top_bg{
position: fixed;
top: 0;
width: 100%;
z-index: 100;
}
.right-menu.full #topmenu {
background-color: #ffffff;
}
.right-menu.full #topmenu .sub-menu li {
padding-left: 10px;
}
}

.header_trans-fixed .mob-nav i {
color: #fff;
}

.header_trans-fixed.header_top_bg {
transition: background-color 300ms ease;
}

.header_trans-fixed.header_top_bg.bg-fixed-color {
background-color: #fff;
}
.header_trans-fixed.header_top_bg.bg-fixed-dark {
background-color: #222;
}
.header_trans-fixed.header_top_bg.bg-fixed-color .mob-nav .line {
background-color: #222;
}
.header_trans-fixed.header_top_bg.bg-fixed-dark .mob-nav:not(.mob-but-full) .line,
.header_trans-fixed.header_top_bg.bg-fixed-dark .mob-but-full:not(.active) .line {
background-color: #fff;
}
.menu_light_text.header_trans-fixed.header_top_bg.bg-fixed-color .logo span,
.header_trans-fixed.header_top_bg.bg-fixed-color .logo span,
.menu_light_text.header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .mini-cart-wrapper .cart-contents-count {
color: #222;
}
.menu_light_text.header_trans-fixed.header_top_bg.bg-fixed-dark .logo span,
.header_trans-fixed.header_top_bg.bg-fixed-dark .logo span {
color: #ffffff;
}
.menu_light_text .right-menu .mob-nav .line {
background-color: #ffffff;
}
.right-menu .topmenu.open .mob-nav .line {
background-color: #222222;
}
.pixxy-top-social {
display: inline-block;
margin-left: 0px;
position: relative;
vertical-align: middle;
}

.pixxy-top-social .social-icon {
display: none;
font-size: 14px;
color: #222222;
opacity: 1;
padding: 0 20px;
cursor: pointer;
transition: opacity 0.3s ease;
position: relative;
z-index: 30;
}

.header_trans-fixed .pixxy-top-social .social-icon {
color: #fff;
}

.pixxy-top-social .social-icon:hover {
opacity: 0.7;
}

#topmenu .pixxy-top-social .social {
margin-left: 0;
}

#topmenu .social li {
display: inline-block;
margin-left: 12px;
}

#topmenu .pixxy-top-social .social li a {
margin-left: 0;
color: #222222;
opacity: 1;
transition: opacity 0.3s ease;
}

.header_trans-fixed .right-menu #topmenu .pixxy-top-social .social li a {
color: #fff;
}

#topmenu .pixxy-top-social .social li a:hover {
opacity: 1;
}

.header_trans-fixed .right-menu #topmenu .pixxy-top-social .social {
background-color: transparent;
}

#topmenu .pixxy-top-social .social li {
margin: 5px;
}

#topmenu .pixxy-top-social .social.active {
visibility: visible;
opacity: 1;
}

#topmenu .pixxy-top-social .social li a {
line-height: 1.2;
}

#topmenu ul > li > ul > li > ul {
display: none;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini-cart-data .mini_cart_item_price {
color: #222;
font-size: 15px;
font-weight: 600;
}

.mini-cart-wrapper {
display: inline-block;
position: relative;
vertical-align: middle;
}

.mini-cart-wrapper .pixxy-shop-icon:hover::before {
color: #999;
}

.mini-cart-wrapper .pixxy-shop-icon:before {
position: relative;
display: inline-block;
line-height: 1;
color: #222222;
font-size: 24px;
}

.mini-cart-wrapper .cart-contents {
display: -webkit-inline-box;
display: -ms-inline-flexbox;
display: inline-flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
position: absolute;
top: -12px;
right: -19px;
width: 20px;
height: 20px;
}

.mini-cart-wrapper .cart-contents-count {
font-size: 12px;
font-weight: 600;
color: #222;
}

.pixxy_mini_cart {
position: absolute;
right: -20px;
top: 50px;
display: block;
background-color: #fff;
opacity: 0;
visibility: hidden;
min-width: 360px;
padding: 23px 30px;
text-align: center;
transition: opacity 0.5s ease, visibility 0.5s ease;
-webkit-box-shadow: 3px 1px 20px 0 rgba(0, 115, 230, 0.08);
box-shadow: 3px 1px 20px 0 rgba(0, 115, 230, 0.08);
}
.header_trans-fixed #topmenu .pixxy_mini_cart .cart_list .mini_cart_item .remove_from_cart_button {
color: #888;
}
#topmenu .pixxy_mini_cart .cart_list .mini_cart_item .remove_from_cart_button {
padding: 0;
color: #888;
font-size: 30px;
font-weight: 400;
line-height: 1;
}
#topmenu .pixxy_mini_cart .pixxy-buttons {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: justify;
-ms-flex-pack: justify;
justify-content: space-between;
margin-bottom: 30px;
}
#topmenu .pixxy_mini_cart .pixxy-buttons a {
display: -webkit-inline-box;
display: -ms-inline-flexbox;
display: inline-flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
color: #222222;
font-size: 15px;
font-weight: 800;
line-height: 2;
text-decoration: none;
}
#topmenu .pixxy_mini_cart .pixxy-buttons a:hover i {
margin-left: 10px;
}
#topmenu .pixxy_mini_cart .pixxy-buttons a i {
margin-left: 8px;
font-size: 12px;
-webkit-transition: all .3s ease;
-o-transition: all .3s ease;
transition: all .3s ease;
}
.woocommerce-mini-cart__total {
margin: 0;
color: #888;
}
.woocommerce-mini-cart__total > span {
margin-left: 10px;
color: #222;
font-size: 18px;
font-weight: 800;
}
.mini-cart-wrapper:hover .pixxy_mini_cart {
opacity: 1;
visibility: visible;
}

#topmenu .pixxy_mini_cart .product_list_widget {
display: block;
}

#topmenu .pixxy_mini_cart .product_list_widget .empty {
font-size: 18px;
line-height: 28px;
letter-spacing: 1.4px;
font-weight: 400;
color: #fff;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item {
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-flex-wrap: nowrap;
-ms-flex-wrap: nowrap;
flex-wrap: nowrap;
-webkit-box-pack: justify;
-ms-flex-pack: justify;
justify-content: space-between;
padding: 0;
padding-bottom: 23px;
margin-bottom: 23px;
border-bottom: 1px solid #888;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini_cart_item_thumbnail {
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
width: 40%;
max-width: 70px;
margin-top: 7px;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini_cart_item_thumbnail a {
padding: 0;
display: block;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini_cart_item_thumbnail img {
float: none;
max-width: 70px;
width: 100%;
margin-left: 0;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini-cart-data {
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-flex-direction: column;
-ms-flex-direction: column;
flex-direction: column;
-webkit-align-items: flex-start;
-ms-flex-align: start;
align-items: flex-start;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
width: 60%;
padding-left: 15px;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini-cart-data .mini_cart_item_name {
font-size: 15px;
line-height: 1.3;
font-weight: 800;
color: #222;
text-align: left;
padding: 0;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini-cart-data .mini_cart_item_quantity {
font-size: 12px;
line-height: 20px;
font-weight: 400;
color: #888;
margin-bottom: 5px;
}

#topmenu .pixxy_mini_cart a.button {
border-radius: 0;
display: block;
padding: 11px 34px;
border: 1px solid #0073e6;
font-size: 15px;
font-weight: 600;
line-height: 2;
text-decoration: none;
background-image: -webkit-gradient(linear,left top,right top,color-stop(50%,transparent),color-stop(50%,#0073e6));
background-image: linear-gradient(to right,transparent 50%,#0073e6 50%);
color: #ffffff;
background-color: #0073e6;
background-size: 200% 100%;
background-position: right bottom;
}
#topmenu .pixxy_mini_cart a.button:focus {
color: #ffffff;
}

#topmenu .pixxy_mini_cart a.button:hover {
color: #0073e6;
border-color: #0073e6;
background-color: transparent;
background-position: left bottom;
}

.header_trans-fixed.none {
display: none;
}

.header_trans-fixed.header_top_bg .mini-cart-wrapper .pixxy-shop-icon .cart-contents-count {
color: #fff;
}

.pixxy_mini_cart .product_list_widget .mini_cart_item .mini_cart_item_thumbnail img {
height: auto;
}

.socials-mob-but {
display: none;
}

.socials-mob-but:active,
.socials-mob-but:visited {
opacity: 1;
}

#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini-cart-data .mini_cart_item_price {
font-size: 12px;
}

.unit .mini-cart-wrapper .pixxy-shop-icon {
font-size: 25px;
}

header .logo img {
max-width: none;
max-height: 75px;
}

header .logo img.logo-hover {
display: none;
}
header .logo:hover {
opacity: 1;
}

.header_trans-fixed .f-right > div:first-child::before {
background: #fff !important;
}

@media only screen and (min-width: 1801px) {
.header_top_bg > .container {
width: 1650px;
}
}

@media only screen and (max-width: 1199px) {
.pixxy-top-social {
margin-left: 5px;
}
}

@media (min-width: <?php echo esc_attr($min_mobile); ?>) {
header .logo img.logo-mobile{
display: none!important;
}
.menu_light_text.header_top_bg .logo span,
.menu_light_text.header_top_bg .right-menu .logo span,
.menu_light_text.header_top_bg .right-menu #topmenu ul li a,
.menu_light_text.header_top_bg .right-menu #topmenu .pixxy-shop-icon::before,
.menu_light_text.header_top_bg .right-menu #topmenu .search-icon-wrapper i,
.menu_light_text.header_top_bg .right-menu .socials-mob-but i,
.menu_light_text.header_top_bg .right-menu .mini-cart-wrapper .cart-contents-count{
color: #ffffff;
}
.menu_light_text.header_top_bg .right-menu #topmenu .sub-menu li a {
color: #222222;
}
.mob-nav-close {
display: none;
}

.header_trans-fixed #topmenu {
background-color: transparent;
}

#topmenu ul ul {
padding: 10px 0;
}

.right-menu .logo{
text-align: left;
}

.right-menu .logo,
.right-menu #top-menu {
display: table-cell;
vertical-align: middle;
}

.top-menu #topmenu ul ul {
left: -20px;
}

.top-menu .pixxy-top-social {
margin-left: 10px;
}

#topmenu ul ul li {
display: block;
margin-bottom: 5px;
}

#topmenu ul ul li:last-child {
margin-bottom: 0;
}

.top-menu #topmenu > ul:not(.social) > li {
margin: 0 10px 5px 10px;
padding: 0;
}

#topmenu ul li:hover > ul {
display: block;
}

#topmenu .f-right > div {
position: relative;
}

#topmenu .f-right > div:last-child::before {
content: none;
}

#topmenu > ul > li > ul > li > ul {
left: -100%;
top: -15px;
}

.sub-menu li a {
z-index: 1999;
}

.pr30md {
padding-right: 30px !important;
padding-left: 0 !important;
}

.right-menu {
width: 100%;
margin: auto;
display: table;
padding: 0;
}

.right-menu .f-right {
float: right;
}

.right-menu .f-right > div {
position: relative;
}

.right-menu .f-right > div:last-child::before {
content: none;
}

header:not(.full) .right-menu #topmenu {
text-align: center;
display: table-cell !important;
margin-top: 0;
vertical-align: middle;
}

.header_trans-fixed.header_top_bg .right-menu:not(.static) #topmenu > ul > li > a {
/*padding: 13px 0 13px;*/
transform: translateZ(0);
}

.header_trans-fixed.header_top_bg .right-menu #topmenu > ul ul {
top: 60px;
}

.header_top_bg.menu_light_text.header_underline .right-menu #topmenu > ul ul {
top: 91px;
}

.header_trans-fixed.header_top_bg .right-menu #topmenu > ul ul ul {
top: -10px;
}

.right-menu #topmenu ul ul {
left: 10px;
top: 44px;
}

.top-menu #topmenu ul ul {
left: -20px;
top: 100%;
}

.right-menu #topmenu > ul > li > ul > li > ul {
left: 100%;
top: -10px;
}

.top-menu #topmenu > ul > li > ul > li > ul {
left: 100%;
top: -10px;
}

.right-menu #topmenu .social {
text-align: right;
vertical-align: top;
}

.right-menu #topmenu .social li a {
padding: 0;
margin-left: 0;
-webkit-transition: color 350ms ease;
-moz-transition: color 350ms ease;
-ms-transition: color 350ms ease;
-o-transition: color 350ms ease;
transition: color 350ms ease;
}

.right-menu #topmenu .social li a:hover {
color: #999;
}

.right-menu #topmenu .social li a::after,
.right-menu #topmenu .social li a::before {
content: none;
}

.right-menu #topmenu > ul > li > a {
position: relative;
padding: 0;
margin: 0 23px;
}

.right-menu #topmenu > ul > li.current-menu-item > a,
.top-menu #topmenu > ul > li.current-menu-item > a,
.right-menu #topmenu > ul > li.current-menu-parent > a,
.top-menu #topmenu > ul > li.current-menu-parent > a {
transition: all 0.5s ease;
}

.right-menu .logo img {
max-height: 75px;
margin: 5px auto;
}
.full-width-menu .right-menu .logo img {
margin: 0;
max-height: 77px;
}

.top-menu #topmenu > ul > li:last-child > ul > li > ul {
left: calc(-100% - 30px);
}

#topmenu .pixxy-top-social .social {
z-index: 25;
text-align: left;
transition: opacity 0.3s ease;
}

header:not(.full) #topmenu ul li.mega-menu {
position: static;
}

header:not(.full).right-menu #topmenu ul .mega-menu > ul {
width: 100%;
max-width: 1140px;
left: 50%;
top: 60px;
padding: 45px 0 30px;
-webkit-transform: translateX(-50%);
-moz-transform: translateX(-50%);
-ms-transform: translateX(-50%);
-o-transform: translateX(-50%);
transform: translateX(-50%);
}

.header_top_bg.menu_light_text.header_underline header:not(.full).right-menu #topmenu ul .mega-menu > ul {
top: 91px;
}

header:not(.full) #topmenu ul li.mega-menu > ul::before {
content: "";
position: absolute;
width: 5000px;
top: 0;
bottom: 0;
left: -100%;
background-color: #fff;
box-shadow: 3px 1px 20px 0 rgba(0, 0, 0, 0.07);
z-index: 1;
}

header:not(.full) #topmenu ul li.mega-menu > ul > li {
float: left;
width: 25%;

}

header:not(.full) #topmenu ul li.mega-menu > ul > li > a {
font-size: 18px;
font-weight: 800;
}

header:not(.full) #topmenu ul li.mega-menu > ul > li:nth-child(1)::before {
left: 25%;
}

header:not(.full) #topmenu ul li.mega-menu > ul > li:nth-child(2)::before {
left: 50%;
}

header:not(.full) #topmenu ul li.mega-menu > ul > li:nth-child(3)::before {
left: 75%;
}

header:not(.full) #topmenu ul > li.mega-menu > ul.sub-menu > li > ul.sub-menu {
display: block;
position: static;
text-align: left;
min-width: 100%;
box-shadow: none;
padding: 25px 0;
transition: all .2s ease;
}

header:not(.full) #topmenu ul > li.mega-menu > ul > li > ul.sub-menu > li {
display: block;
padding: 8px 0;
}
header:not(.full) #topmenu ul > li.mega-menu > ul > li > ul.sub-menu > li a {
opacity: 0;
-webkit-transform: matrix(1, 0, 0, 1, 0, 20);
-ms-transform: matrix(1, 0, 0, 1, 0, 20);
transform: matrix(1, 0, 0, 1, 0, 20);
-webkit-transition: opacity .75s ease, -webkit-transform .75s ease, color .5s ease;
transition: opacity .75s ease, -webkit-transform .75s ease, color .5s ease;
-o-transition: opacity .75s ease, transform .75s ease, color .5s ease;
transition: opacity .75s ease, transform .75s ease, color .5s ease;
transition: opacity .75s ease, transform .75s ease, -webkit-transform .75s ease, color .5s ease;
}
header:not(.full).right-menu #topmenu ul .mega-menu ul li {
position: static;
display: block;
}

header.top-menu #topmenu ul li.mega-menu > ul {
top: calc(100% - 25px);
}

header.top-menu #topmenu ul li.mega-menu > ul > li::before {
display: none;
}

header.top-menu #topmenu ul ul {
left: 0;
}

header.top-menu #topmenu ul li.mega-menu > ul > li:nth-child(1)::before,
header.top-menu #topmenu ul li.mega-menu > ul > li:nth-child(2)::before,
header.top-menu #topmenu ul li.mega-menu > ul > li:nth-child(3)::before {
left: 100%;
display: block;
top: 0;
}

.top-menu .logo span {
padding: 24px 10px;
}

header.top-menu .logo span {
padding: 15px 10px;
}

.right-menu .logo span {
float: left;
}

.top-menu #topmenu > ul:not(.social) > li {
margin: 0 0 5px;
padding: 0 23px;
}

.top-menu #topmenu > ul > li:last-child > ul > li > ul {
left: calc(-100%);
}

.top-menu #topmenu > ul > li > ul > li > ul {
left: calc(100% + 23px);
}
}

@media (min-width: <?php echo esc_attr($min_mobile); ?>) and (max-width: 1199px) {
.right-menu #topmenu > ul > li > a {
margin: 0 18px;
}
}

@media (min-width: <?php echo esc_attr($max_mobile); ?>) {

.main-wrapper.unit .right-menu #topmenu > ul > li > a {
margin: 0 15px;
}
}
@media only screen and (min-width: <?php echo esc_attr($max_mobile); ?>) and (max-width: 1100px) {
.main-wrapper.unit .right-menu #topmenu > ul > li > a {
margin: 0 10px;
}
}


/*------------------------------------------------------*/
/*---------------------- MOBILE MENU ----------------------*/
@media (max-width: <?php echo esc_attr($max_mobile); ?>) {

.header_top_bg{
position: fixed;
top: 0;
width: 100%;
z-index: 100;
}

header .logo img.main-logo:not(.logo-mobile){
display: none!important;
}
header .logo img.logo-mobile{
display: inline;
padding: 10px 0;
}

.header_top_bg > .container {
width: 100%;
}

#topmenu {
overflow-x: hidden;
}

.header_trans-fixed.header_top_bg .mini-cart-wrapper .cart-contents-count {
color: #222222;
}

.main-wrapper {
width: 100%;
}

.main-wrapper header .logo img {
max-height: 75px;
}

header {
padding: 10px;
}

#topmenu ul li ul {
box-shadow: none;
font-style: normal;
}

#topmenu ul {
box-shadow: none;
font-style: normal;
}

.header_top_bg > .container > .row > .col-xs-12 {
padding: 0;
}

.top-menu .logo {
margin-bottom: 0;
margin-top: 0;
}

.no-padd-mob {
padding: 0 !important;
}
.right-menu #topmenu .menu li.menu-item-has-children,
#topmenu .menu li.menu-item-has-children {
position: relative;
text-align: left;
}
.right-menu #topmenu .menu li.menu-item-has-children i,
#topmenu .menu li.menu-item-has-children i {
position: absolute;
top: 14px;
right: 25px;
}

.right-menu #topmenu .menu li.menu-item-has-children > a,
#topmenu .menu li.menu-item-has-children > a {
position: relative;
display: inline-block;
width: auto!important;
}
.unit .mob-nav {
right: 10px;
}
.mob-nav {
display: block;
margin: 0;
position: absolute;
top: 50%;
right: 10px;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
}

.mob-nav i::before {
font-size: 24px;
}
.sidebar-open {
height: 100vh;
}
.sidebar-open .canvas-wrap {
left: 320px;
}
.sidebar-open .header_top_bg {
position: fixed;
}
.main-wrapper {
left: 0;
transition: all .5s ease-in-out;
}
.main-wrapper::before {
content: '';
display: block;
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.75);
z-index: 400;
opacity: 0;
visibility: hidden;
-webkit-transition: all 0.5s ease-in-out;
transition: all 0.5s ease-in-out;
}
.sidebar-open .main-wrapper {
left: 320px;
overflow: visible;
}
.sidebar-open .main-wrapper::before {
opacity: 1;
visibility: visible;
}
.mob-nav-close {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: end;
-ms-flex-pack: end;
justify-content: flex-end;
text-decoration: none;
border-bottom: 1px solid #f1f2f3;
padding: 30px 0;
}
.mob-nav-close span {
font-size: 12px;
text-transform: uppercase;
}
.mob-nav-close .hamburger {
padding: 0 20px;
padding-left: 15px;
}
.mob-nav-close .line {
display: block;
width: 24px;
height: 2px;
background-color: #222222;
}

.mob-nav-close .line:first-of-type {
-webkit-transform: rotate(45deg) translateY(2px);
-moz-transform: rotate(45deg) translateY(2px);
-ms-transform: rotate(45deg) translateY(2px);
-o-transform: rotate(45deg) translateY(2px);
transform: rotate(45deg) translateY(2px);
}

.mob-nav-close .line:last-of-type {
-webkit-transform: rotate(-45deg) translateY(-1px);
-moz-transform: rotate(-45deg) translateY(-1px);
-ms-transform: rotate(-45deg) translateY(-1px);
-o-transform: rotate(-45deg) translateY(-1px);
transform: rotate(-45deg) translateY(-1px);
}


#topmenu {
display: inline-block;
overflow-y: auto;
position: fixed;
text-align: left;
padding-top: 0;
padding-bottom: 100px;
top: 0;
bottom: 0;
width: 320px;
left: -320px;
background-color: #fff;
height: 100vh;
z-index: 100;
transition: all .5s ease-in-out;
}
.sidebar-open #topmenu {
position: fixed;
left: 0;
}
#topmenu ul ul {
display: none;
position: static;
}

#topmenu ul.menu > li > ul > li > ul {
display: none;
}

#topmenu ul.menu {
width: 100%;
display: inline-block;
padding-bottom: 30px;
background-color: #fff;
}

#topmenu ul.menu li {
display: block !important;
float: none;
text-align: left;
margin-bottom: 0;
}

#topmenu ul.menu li a::before{
content: '';
position: absolute;
bottom: 0;
left: 0;
width: 320px;
height: 1px;
display: block;
background-color: #f1f2f3;
}
#topmenu ul.menu li a {
font-size: 15px;
font-weight: 600;
color: #222222;
padding: 10px 25px;
line-height: 25px;
display: inline-block;
width: auto!important;
float: none;
transition: all 0.5s ease;
}


/*2 level menu*/
#topmenu > ul.menu > li > ul > li,
#topmenu > ul.menu > li > ul > li > ul > li {
padding-left: 10px;

}

#topmenu .social li a {
line-height: 25px !important;
}

#topmenu .menu li a:hover,
#topmenu .menu .current-menu-parent > a,
#topmenu .menu .current-menu-item > a,
#topmenu .menu .current-menu-ancestor > a {
color: #0073e6;
}

.right-menu #topmenu .social {
display: block;
}

.right-menu #topmenu .social li {
display: inline-block;
}

.right-menu #topmenu .social li a {
padding: 5px;
}

.pixxy-top-social .social-icon {
display: none;
}

.right-menu #topmenu .pixxy-top-social .social {
position: static;
visibility: visible;
opacity: 1;
}

.header_trans-fixed.open .right-menu #topmenu .pixxy-top-social .social li a {
color: #222222;
}

.mini-cart-wrapper {
display: block;
margin: 20px 10px 30px 10px;
}

.pixxy_mini_cart {
opacity: 1;
visibility: visible;
position: relative;
right: auto;
left: 0;
top: 10px;
width: 100%;
min-width: 0;
}

#topmenu ul li.mega-menu:hover > ul > li {
width: 100%;
}

header a.logo {
display: inline-block;
}

#topmenu ul li.mega-menu:hover > ul > li {
width: auto;
}

#topmenu.active-socials {
left: 0;
right: 0;
overflow: visible;
opacity: 1;
width: 100%;
}

#topmenu .f-right {
display: block;
background: #fff;
padding: 15px;
text-align: center;
z-index: 9999;
width: 100%;
transition: all 350ms ease;
}

#topmenu .f-right.active-socials {
opacity: 1;
visibility: visible;
}

#topmenu .f-right.active-socials a {
visibility: visible;
}

#topmenu .f-right .header_trans-fixed.open .right-menu #topmenu .pixxy-top-social .social li a {
transition: none;
}

.socials-mob-but {
display: block;
margin: 0;
position: absolute;
top: calc(50% + -3px);
right: 20px;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
}

.socials-mob-but i::before {
font-size: 24px;
}

#topmenu .social .fa,
.mini-cart-wrapper .pixxy-shop-icon {
font-size: 28px;
transition: none;
}

.mini-cart-wrapper {
margin: 0;
}

.header_trans-fixed.header_top_bg.open header .socials-mob-but i,
.header_trans-fixed #topmenu .pixxy-top-social .social li a,
.header_trans-fixed .mini-cart-wrapper .pixxy-shop-icon::before {
color: #222222 !important;
}

.header_trans-fixed.header_top_bg {
transition: none;
}

.mini-cart-wrapper {
display: inline-block;
vertical-align: middle;
}

.pixxy_mini_cart {
display: none;
}

.pixxy-top-social {
vertical-align: middle;
margin-left: 0;
}

.mini-cart-wrapper .pixxy-shop-icon:before {
margin-top: -3px;
font-size: 28px;
}

.header_trans-fixed.header_top_bg.open {
background-color: #fff;
position: fixed;
z-index: 1000;
top: 0;
width: 100%;
}
.header_trans-fixed.menu_light_text .right-menu .mob-nav .hamburger i {
color: #ffffff;
}
.header_trans-fixed .right-menu .mob-nav .hamburger i,
.header_trans-fixed.bg-fixed-color .right-menu .mob-nav .hamburger i {
color: #222222;
}
.header_trans-fixed.bg-fixed-dark .right-menu .mob-nav .hamburger i {
color: #fff;
}
.search-form input {
width: 100%;
border: 0;
border-bottom: 1px solid #222;
background-color: transparent;
color: #888;
font-size: 15px;
padding: 14px 0;
}
.search-icon-wrapper {
display: block;
position: relative;
margin-bottom: 30px;
}
.search-icon-wrapper i {
position: absolute;
top: 50%;
right: 20px;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
-ms-transform: translateY(-50%);
-o-transform: translateY(-50%);
transform: translateY(-50%);
}
.search-icon-wrapper .input-group {
width: 100%;
}
}

/*------------------------------------------------------*/
/*---------------------- CLASSIC MENU ----------------------*/
@media only screen and (min-width: <?php echo esc_attr($min_mobile); ?>) {
.container-fluid header.classic {
padding: 0 10px;
}
header.classic {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.unit header.classic {
padding: 0 15px;
}

.classic #topmenu {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
padding-left: 35px;
}

.classic #topmenu .menu {
width: 100%;
text-align: center;
}

.unit .classic #topmenu .menu {
text-align: right;
}

.classic .f-right {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.header_trans-fixed.header_top_bg .classic #topmenu ul li a {
padding: 0;
}

.classic #topmenu .menu li a {
color: #222222;
font-size: 15px;
font-weight: bold;
line-height: 2;
}

.classic #topmenu .menu li a:hover,
.classic #topmenu .menu .current-menu-parent > a,
.classic #topmenu .menu .current-menu-item > a,
.classic #topmenu .menu .current-menu-ancestor > a {
color: #0073e6;
}

.classic #topmenu .menu > li {
padding: 30px 0;
}

.header_underline.header_top_bg.menu_light_text #topmenu .menu > li > a {
position: relative;
}

.header_underline.header_top_bg.menu_light_text #topmenu .menu > li > a:after {
position: absolute;
bottom: -31px;
display: block;
content: '';
height: 2px;
background-color: #fff;
opacity: 0;
transition: 0.3s;
left: 50%;
right: 50%;
}

.header_underline.header_top_bg.menu_light_text.bg-fixed-color #topmenu .menu > li > a:after {
background-color: #222;
}

.header_underline.header_top_bg.menu_light_text #topmenu .menu > li.current-menu-ancestor > a:after,
.header_underline.header_top_bg.menu_light_text #topmenu .menu > li:hover > a:after{
opacity: 1;
left: -4px;
right: -4px;
}

.classic #topmenu .sub-menu {
top: 75px;
left: -35px;
min-width: 270px;
padding: 30px 0;
background-color: #ffffff;
-webkit-box-shadow: 3px 1px 20px 0 rgba(0, 115, 230, 0.08);
box-shadow: 3px 1px 20px 0 rgba(0, 115, 230, 0.08);
opacity: 0;
visibility: hidden;
-webkit-transition: opacity .3s ease, visibility .3s ease;
-o-transition: opacity .3s ease, visibility .3s ease;
transition: opacity .3s ease, visibility .3s ease;
display: block;
}

.classic #topmenu .menu li:hover > ul {
opacity: 1;
visibility: visible;
}

.classic #topmenu .menu > li ul a {
opacity: 0;
-webkit-transform: matrix(1, 0, 0, 1, 0, 20);
-ms-transform: matrix(1, 0, 0, 1, 0, 20);
transform: matrix(1, 0, 0, 1, 0, 20);
-webkit-transition: opacity .75s ease, color .5s ease, -webkit-transform .75s ease;
transition: opacity .75s ease, color .5s ease, -webkit-transform .75s ease;
-o-transition: opacity .75s ease, transform .75s ease, color .5s ease;
transition: opacity .75s ease, transform .75s ease, color .5s ease;
transition: opacity .75s ease, transform .75s ease, color .5s ease, -webkit-transform .75s ease;
}

.classic #topmenu .menu > li:hover ul a,
.classic #topmenu .menu > li.mega-menu:hover ul > li > ul.sub-menu > li a {
opacity: 1;
-webkit-transform: matrix(1, 0, 0, 1, 0, 0);
-ms-transform: matrix(1, 0, 0, 1, 0, 0);
transform: matrix(1, 0, 0, 1, 0, 0);
}

.classic #topmenu .sub-menu .sub-menu {
top: 0;
left: 100%;
padding: 40px 15px;
}

.classic #topmenu .menu li:last-of-type .sub-menu .sub-menu,
.classic #topmenu .menu li:nth-last-of-type(2) .sub-menu .sub-menu,
.classic #topmenu .menu li:nth-last-of-type(3) .sub-menu .sub-menu,
.classic #topmenu .menu li:nth-last-of-type(4) .sub-menu .sub-menu {
left: auto;
right: 100%;
}

.classic #topmenu .sub-menu li {
padding: 8px 35px;
text-align: left;
}

.classic #topmenu .sub-menu li a {
width: auto;
display: inline-block;
padding: 0;
}

.classic #topmenu .current-menu-parent > a,
.classic #topmenu .current-menu-item > a {
position: relative;
}

.classic #topmenu > ul > li > a {
margin: 0 45px 0 0;
}

.classic #topmenu .mini-cart-wrapper {
margin-left: 20px;
}

/* mega menu classic*/
.classic #topmenu .menu .mega-menu:hover > ul > li > ul {
opacity: 1;
visibility: visible;
}

/* end of mega menu classic*/
/* search popup */
.classic .site-search {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 100;
background-color: rgba(255, 255, 255, .9);
overflow-x: hidden;
overflow-y: auto;
opacity: 0;
visibility: hidden;
-webkit-transition: opacity .7s ease, visibility .7s ease;
-o-transition: opacity .7s ease, visibility .7s ease;
transition: opacity .7s ease, visibility .7s ease;
}

.classic .site-search.open {
opacity: 1;
visibility: visible;
}

.classic .site-search .form-container {
position: relative;
top: 50%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
}

.classic .site-search .form-container .input-group {
width: 100%;
}

.classic .site-search .form-container .input-group input {
font-size: 18px;
}

.classic .site-search .close-search {
position: absolute;
top: 60px;
right: 135px;
width: 30px;
height: 30px;
}

.classic .site-search .line {
width: 27px;
height: 2px;
background-color: #222222;
display: block;
margin: 4px auto;
-webkit-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;
}

.classic .site-search .line:nth-of-type(1) {
-webkit-transform: translateY(10px) rotate(45deg);
-ms-transform: translateY(10px) rotate(45deg);
-o-transform: translateY(10px) rotate(45deg);
transform: translateY(10px) rotate(45deg);
}

.classic .site-search .line:nth-of-type(2) {
-webkit-transform: translateY(4px) rotate(-45deg);
-ms-transform: translateY(4px) rotate(-45deg);
-o-transform: translateY(4px) rotate(-45deg);
transform: translateY(4px) rotate(-45deg);
}

.search-form input {
width: 100%;
border: 0;
border-bottom: 1px solid #222;
background-color: transparent;
color: #999999;
font-size: 15px;
padding: 14px 0;
}

.classic #topmenu .search-icon-wrapper {
margin-left: 10px;
cursor: pointer;
font-size: 27px;
color: #222;
line-height: 1;
}

.classic #topmenu .search-icon-wrapper:hover {
color: #888;
}

/* end of search popup */

}
@media only screen and (min-width: <?php echo esc_attr($min_mobile); ?>) and (max-width: 1240px) {
.classic #topmenu > ul > li > a {
margin: 0 30px 0 0;
}
}

@media only screen and (min-width: 1201px) {
.container-fluid header.classic {
padding: 0 85px;
}
}


<?php
$style = '';
///HEADER LOGO//
if (cs_get_option('site_logo') == 'txtlogo') {
    //Header logo text
    if (cs_get_option('text_logo_style') == 'custom') {

        $style .= 'a.logo span{';
        $style .=  cs_get_option('text_logo_color') && cs_get_option('text_logo_color') !== '#fff' ? 'color:' . cs_get_option('text_logo_color') . ' !important;' : '';
        $style .=  cs_get_option('text_logo_width') ? 'width:' . cs_get_option('text_logo_width') . ' !important;' : '';
        $style .=  cs_get_option('text_logo_font_size') ? 'font-size:' . cs_get_option('text_logo_font_size') . ' !important;' : '';
        $style .= '}';
    }
} else {
    //Header logo image
    if (cs_get_option('img_logo_style') == 'custom') {
        $style .= '.logo img {';
        if (cs_get_option('img_logo_width')) {
            $logo_width = is_integer(cs_get_option('img_logo_width')) ? cs_get_option('img_logo_width') . 'px' : cs_get_option('img_logo_width');
            $style .=  cs_get_option('img_logo_width') ? 'width:' . esc_attr($logo_width) . ' !important;' : '';
        }
        if (cs_get_option('img_logo_height')) {
            $logo_height = is_integer(cs_get_option('img_logo_height')) ? cs_get_option('img_logo_height') . 'px' : cs_get_option('img_logo_height');
            $style .=  cs_get_option('img_logo_height') ? 'height:' . esc_attr($logo_height) . ' !important;' : '';
            $style .=  cs_get_option('img_logo_height') ? 'max-height:' . cs_get_option('img_logo_height') . ' !important;' : '';
        }
        $style .= '}';
    }
}
echo esc_html($style);

$post_id = isset($_GET['post']) && is_numeric($_GET['post']) ? $_GET['post'] : '';

if (!empty($post_id)) {
    $meta_data = get_post_meta($post_id, '_custom_page_options', true);
    $meta_data_portfolio = get_post_meta($post_id, 'pixxy_portfolio_options', true);
    $meta_data_events    = get_post_meta($post_id, 'pixxy_events_options', true);

    if (isset($meta_data['footer_color']) && !empty($meta_data['footer_color'])) {
        $footer_color = $meta_data['footer_color'];
    } elseif (isset($meta_data_portfolio['footer_color']) && !empty($meta_data_portfolio['footer_color'])) {
        $footer_color = $meta_data_portfolio['footer_color'];
    } elseif (isset($meta_data_events['footer_color']) && !empty($meta_data_events['footer_color'])) {
        $footer_color = $meta_data_events['footer_color'];
    }

    if (isset($footer_color) && !empty($footer_color)) { ?>
        .page-id-<?php echo esc_attr($post_id); ?> #footer,
        .postid-<?php echo esc_attr($post_id); ?> #footer {
        background-color: <?php echo esc_html($footer_color) ?>;
        }
    <?php }

        if (isset($meta_data['header_scroll_bg']) && !empty($meta_data['header_scroll_bg'])) {
            $header_scroll_bg = $meta_data['header_scroll_bg'];
        } elseif (isset($meta_data_portfolio['header_scroll_bg']) && !empty($meta_data_portfolio['header_scroll_bg'])) {
            $header_scroll_bg = $meta_data_portfolio['header_scroll_bg'];
        } elseif (isset($meta_data_events['header_scroll_bg']) && !empty($meta_data_events['header_scroll_bg'])) {
            $header_scroll_bg = $meta_data_events['header_scroll_bg'];
        }

        if (isset($header_scroll_bg) && !empty($header_scroll_bg)) { ?>
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color {
        background-color: <?php echo esc_html($header_scroll_bg) ?>;
        }
    <?php }

        if (isset($meta_data['header_scroll_text']) && !empty($meta_data['header_scroll_text'])) {
            $header_scroll_text = $meta_data['header_scroll_text'];
        } elseif (isset($meta_data_portfolio['header_scroll_text']) && !empty($meta_data_portfolio['header_scroll_text'])) {
            $header_scroll_text = $meta_data_portfolio['header_scroll_text'];
        } elseif (isset($meta_data_events['header_scroll_text']) && !empty($meta_data_events['header_scroll_text'])) {
            $header_scroll_text = $meta_data_events['header_scroll_text'];
        }

        if (isset($header_scroll_text) && !empty($header_scroll_text)) { ?>

        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu:not(.open) ul li a,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .search-icon-wrapper i,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .mini-cart-wrapper .pixxy-shop-icon::before,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .pixxy-top-social .social li a,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .header_top_bg .right-menu.full #topmenu ul li a,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .logo span,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .top-menu .logo span,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu:not(.open) ul li a,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .search-icon-wrapper i,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .mini-cart-wrapper .pixxy-shop-icon::before,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .pixxy-top-social .social li a,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .header_top_bg .right-menu.full #topmenu ul li a,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .logo span,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .top-menu .logo span {
        color: <?php echo esc_html($header_scroll_text) ?>;
        }

        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu.full .mob-nav:not(.active) .line,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu.full .mob-nav:not(.active) .line {
        background-color: <?php echo esc_html($header_scroll_text) ?>;
        }

        @media only screen and (max-width: <?php echo esc_attr($max_mobile); ?>) {
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .mob-nav-close,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu ul.menu li a,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .mob-nav-close,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu ul.menu li a {
        color: <?php echo esc_html($header_scroll_text) ?>;
        }

        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .mob-nav-close .line,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .mob-nav:not(.mob-but-full) .line,
        .page-id-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .mob-but-full:not(.active) .line,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .mob-nav-close .line,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .mob-nav:not(.mob-but-full) .line,
        .postid-<?php echo esc_attr($post_id); ?> .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .mob-but-full:not(.active) .line {
        background-color: <?php echo esc_html($header_scroll_text) ?>;
        }
        }
    <?php }

        if (!empty($meta_data['padding_desktop'])) { ?>
        .page-id-<?php echo esc_attr($post_id); ?> .padding-desc,
        .page-id-<?php echo esc_attr($post_id); ?> .padding-desc .vc_row,
        .page-id-<?php echo esc_attr($post_id); ?> .padding-desc + #footer > div {
        padding-right: <?php echo esc_attr($meta_data['padding_desktop']); ?>;
        padding-left: <?php echo esc_attr($meta_data['padding_desktop']); ?>;
        }

    <?php }

        if (!empty($meta_data['padding_mobile'])) { ?>

        @media only screen and (max-width: 767px) {
        .page-id-<?php echo esc_attr($post_id); ?> .padding-mob,
        .page-id-<?php echo esc_attr($post_id); ?> .padding-mob .vc_row,
        .page-id-<?php echo esc_attr($post_id); ?> .padding-mob + #footer > div {
        padding-right: <?php echo esc_attr($meta_data['padding_mobile']); ?>;
        padding-left: <?php echo esc_attr($meta_data['padding_mobile']); ?>;
        }
        }

        @media (min-width: 768px) {
        .right-menu {
        width: 100%;
        margin: 0;
        max-width: 100%;
        }

        .header_top_bg .col-xs-12 {
        padding: 0;
        }
        }

<?php }
} ?>

/**** WHITE VERSION ****/

<?php

if (cs_get_option('change_colors')) {
    if (cs_get_option('menu_bg_color') && cs_get_option('menu_bg_color') !== '#ffffff') { ?>
        .header_top_bg,
        #topmenu {
        background-color: <?php echo esc_html(cs_get_option('menu_bg_color')) ?>;
        }

        @media only screen and (max-width: <?php echo esc_attr($max_mobile); ?>) {
        #topmenu ul.menu,
        #topmenu .f-right {
        background-color: <?php echo esc_html(cs_get_option('menu_bg_color')) ?>;
        }
        }

    <?php }
        if (cs_get_option('menu_font_color') && cs_get_option('menu_font_color') !== '#222222') { ?>
        #topmenu ul li a,
        #topmenu .search-icon-wrapper i,
        .mini-cart-wrapper .pixxy-shop-icon:before,
        #topmenu .pixxy-top-social .social li a,
        .header_top_bg .right-menu.full #topmenu ul li a,
        .right-menu .logo span,
        .top-menu .logo span,
        .classic #topmenu .menu li a,
        .mini-cart-wrapper .cart-contents-count,
        .modern #topmenu .menu li a,
        .modern .search-form input,
        .modern .search-form input::placeholder {
        color: <?php echo esc_html(cs_get_option('menu_font_color')) ?>;
        }

        .modern .search-form input {
        border-bottom-color: <?php echo esc_html(cs_get_option('menu_font_color')) ?>;
        }

        @media only screen and (max-width: <?php echo esc_attr($max_mobile); ?>) {
        .mob-nav-close,
        #topmenu ul.menu li a,
        .right-menu .mob-nav .hamburger i,
        .right-menu #topmenu .menu li.menu-item-has-children i,
        #topmenu .menu li.menu-item-has-children i,
        .search-form input {
        color: <?php echo esc_html(cs_get_option('menu_font_color')) ?>;
        }

        .mob-nav-close .line,
        .right-menu .mob-nav .line {
        background-color: <?php echo esc_html(cs_get_option('menu_font_color')) ?>;
        }

        .search-form input {
        border-bottom-color: <?php echo esc_html(cs_get_option('menu_font_color')) ?>;
        }
        }

    <?php }
        if (cs_get_option('menu_font_color_t') && cs_get_option('menu_font_color_t') !== '#222222') { ?>
        .header_trans-fixed #topmenu ul li a,
        .header_trans-fixed #topmenu .search-icon-wrapper i,
        .header_trans-fixed .mini-cart-wrapper .pixxy-shop-icon:before,
        .header_trans-fixed #topmenu .pixxy-top-social .social li a,
        .header_trans-fixed .right-menu .logo span,
        .header_trans-fixed .top-menu .logo span,
        .header_trans-fixed .classic #topmenu .menu li a,
        .header_trans-fixed .mini-cart-wrapper .cart-contents-count,
        .header_trans-fixed .modern #topmenu .menu li a,
        .header_trans-fixed .modern .search-form input,
        .header_trans-fixed .modern .search-form input::placeholder,
        .header_trans-fixed.header_top_bg .pixxy-shop-icon .cart-contents-count {
        color: <?php echo esc_html(cs_get_option('menu_font_color_t')) ?>;
        }

        .header_trans-fixed .about-mob-section-wrap .about-hamburger .line {
        background-color: <?php echo esc_html(cs_get_option('menu_font_color_t')) ?>;
        }

        .header_trans-fixed .modern .search-form input {
        border-bottom-color: <?php echo esc_html(cs_get_option('menu_font_color_t')) ?>;
        }

        @media only screen and (max-width: <?php echo esc_attr($max_mobile); ?>) {
        .header_trans-fixed .mob-nav-close,
        .header_trans-fixed #topmenu ul.menu li a,
        .header_trans-fixed .right-menu .mob-nav .hamburger i,
        .header_trans-fixed .right-menu #topmenu .menu li.menu-item-has-children i,
        .header_trans-fixed #topmenu .menu li.menu-item-has-children i,
        .header_trans-fixed .search-form input {
        color: <?php echo esc_html(cs_get_option('menu_font_color_t')) ?>;
        }

        .header_trans-fixed .mob-nav-close .line,
        .header_trans-fixed .right-menu .mob-nav .line {
        background-color: <?php echo esc_html(cs_get_option('menu_font_color_t')) ?>;
        }

        .header_trans-fixed .search-form input {
        border-bottom-color: <?php echo esc_html(cs_get_option('menu_font_color_t')) ?>;
        }
        }

    <?php }
        if (cs_get_option('submenu_bg_color') && cs_get_option('submenu_bg_color') !== '#ffffff') { ?>
        @media only screen and (min-width: <?php echo esc_attr($min_mobile); ?>) {
        header:not(.full) #topmenu ul li.mega-menu:hover > ul::before,
        .classic #topmenu .sub-menu,
        .modern #topmenu .sub-menu {
        background-color: <?php echo esc_html(cs_get_option('submenu_bg_color')) ?>;
        }
        }

        @media only screen and (max-width: <?php echo esc_attr($max_mobile); ?>) {
        #topmenu ul li ul {
        background-color: <?php echo esc_html(cs_get_option('submenu_bg_color')) ?>;
        }
        }

    <?php }
        if (cs_get_option('menu_bg_color_scroll') && cs_get_option('menu_bg_color_scroll') !== '#ffffff') { ?>
        .header_trans-fixed.header_top_bg.bg-fixed-color {
        background-color: <?php echo esc_html(cs_get_option('menu_bg_color_scroll')) ?> !important;
        }

    <?php }
        if (cs_get_option('menu_text_color_scroll') && cs_get_option('menu_text_color_scroll') !== '#222222') { ?>
        .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu ul li a,
        .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .search-icon-wrapper i,
        .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .mini-cart-wrapper .pixxy-shop-icon::before,
        .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu .pixxy-top-social .social li a,
        .header_trans-fixed.header_top_bg.bg-fixed-color .header_top_bg .right-menu.full #topmenu ul li a,
        .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu.full .mob-nav > span,
        .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .logo span,
        .header_trans-fixed.header_top_bg.bg-fixed-color .full-menu-wrap .info-wrap,
        .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu.full .copy,
        .header_trans-fixed.header_top_bg.bg-fixed-color .top-menu .logo span,
        .header_trans-fixed.header_top_bg.bg-fixed-color .mini-cart-wrapper .cart-contents-count,
        .header_trans-fixed.header_top_bg.bg-fixed-color .modern .search-form input,
        .header_trans-fixed.header_top_bg.bg-fixed-color .modern .search-form input::placeholder {
        color: <?php echo esc_html(cs_get_option('menu_text_color_scroll')) ?>;
        }

        .header_trans-fixed.header_top_bg.bg-fixed-color .about-mob-section-wrap .about-hamburger .line {
        background-color: <?php echo esc_html(cs_get_option('menu_text_color_scroll')) ?>;
        }

        .header_trans-fixed.header_top_bg.bg-fixed-color .modern .search-form input {
        border-bottom-color: <?php echo esc_html(cs_get_option('menu_text_color_scroll')) ?>;
        }

        @media only screen and (max-width: <?php echo esc_attr($max_mobile); ?>) {
        .header_trans-fixed.header_top_bg.bg-fixed-color .mob-nav-close,
        .header_trans-fixed.header_top_bg.bg-fixed-color #topmenu ul.menu li a,
        .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .mob-nav .hamburger i {
        color: <?php echo esc_html(cs_get_option('menu_text_color_scroll')) ?>;
        }

        .header_trans-fixed.header_top_bg.bg-fixed-color .mob-nav-close .line,
        .header_trans-fixed.header_top_bg.bg-fixed-color .right-menu .mob-nav .line {
        background-color: <?php echo esc_html(cs_get_option('menu_text_color_scroll')) ?>;
        }
        }

    <?php } ?>

    /* ======= FRONT COLOR 1 ======= */

    <?php if (cs_get_option('front_color_1') && cs_get_option('front_color_1') !== '#0073e6') : ?>

        #grid-121 .tg-nav-color:not(.dots):not(.tg-dropdown-value):not(.tg-dropdown-title):hover,
        #grid-121 .tg-nav-color:hover .tg-nav-color,
        #grid-121 .tg-page-number.tg-page-current,
        #grid-121 .tg-filter.tg-filter-active span,
        .a-btn:hover,
        .a-btn-style-1 .wpcf7-form input[type="submit"]:hover,
        .a-btn-6,
        .a-btn-6:focus,
        .a-btn-6:hover,
        .wpb_text_column h1 b,.wpb_text_column h1 strong,.wpb_text_column h2 b,.wpb_text_column h2 strong,.wpb_text_column h3 b,.wpb_text_column h3 strong,.wpb_text_column h4 b,.wpb_text_column h4 strong,.wpb_text_column h5 b,.wpb_text_column h5 strong,.wpb_text_column h6 b,.wpb_text_column h6 strong,
        .col-md-4 .sidebar-item.widget_rss a.rsswidget:hover,.col-md-3 .sidebar-item.widget_rss a.rsswidget:hover,
        .protected-page form input[type="submit"]:hover,
        .simple_slider .info-wrap .social-list a:hover,
        .simple_slider .blockquote::before,
        .urban .social-list a:hover,
        .tile_info .text-gallery-wrap .text-wrap .text h6,
        .tile_info .blockquote::before,
        .tile_info .social-list a:hover,
        .alia .social-list a:hover,
        .menio .banner-wrap .social-list li a:hover,
        .menio .blockquote cite,
        .menio .social-list a:hover,
        .parallax-window .content-parallax .category-parallax a,
        .woocommerce ul.products li.product .category-product a,
        .pixxy_product_detail .social-list a:hover,
        .woocommerce div.product p.stock,
        .post-little-banner .page-title-blog span,
        .post.center-style .category a,
        .blog.masonry .metro-style.sticky .title::before,
        .main-wrapper .col-md-4 .sidebar-item a:hover,.main-wrapper .col-md-3 .sidebar-item a:hover,
        .post-details .link-wrap a:hover,
        .user-info-wrap .post-author__social a:hover,
        .unit .single-post a:hover,.unit .single-content a:hover,
        .coming-soon .count,
        .discount__content .title b,
        .headings .subtitle b,
        .headings .title b,
        .headings.typing .title .typed,.headings.typing .title .typed-cursor,
        .info-list .info-item .title:before,
        .insta-descr a,
        .last-posts .post-item .post-categories a,
        .line-of-images.logos.logos2 .show-more,
        .line-icons-wrap .icons-item:before,
        .split_slider .split-wrapper .author,
        .pricing .pricing-item-title,
        .pricing .pricing-item-params-list p:before,
        .pricing-simple-cost,
        .pricing-simple-params p:before,
        .product-slider-wrapper .btn-wrap.light>a,
        .product-slider-wrapper .socials a:hover,
        .product-slider-wrapper .additional-link:hover,.product-slider-wrapper .additional-email:hover,
        .product-tabs-wrapper .filters ul li:hover,.product-tabs-wrapper .filters ul li.active,
        .product-tabs-wrapper .filters ul li:hover span,.product-tabs-wrapper .filters ul li.active span,
        .px-services-list__link,
        .px-services-list__link:hover,
        .split-wrapper .subtitle,
        .px-testimonial.flipping .flip-current .position,
        .px-slider__item--iterator:before,
        .px-testimonial.multiple .position,
        .last-post-button a:before,
        .split-wrapper .wpcf7 textarea:focus,.split-wrapper .wpcf7 input:not([type="submit"]):focus,
        .px-slider.horizontal_2 .px-slider__item--iterator:after,
        .px-slider.horizontal_2 .px-slider__title>i,
        .banner-slider-wrap.vertical-2 .title b,
        .banner-slider-wrap.vertical-2 .swiper-pagination .swiper-pagination-bullet-active i,
        .no-menu>a,
        .protected-page form input:not([type="submit"]):focus {
        color: <?php echo esc_html(cs_get_option('front_color_1')) ?>;
        }

        .px-parallax__video-wrapper .play-button,
        ::-moz-selection,
        ::selection,
        .preloader-modern .loader-title::after,
        .showcase_slider .slide-title,
        mark,ins {
        background: <?php echo esc_html(cs_get_option('front_color_1')) ?>;
        }

        .post-media .video-content .play:hover,
        .post.center-style.format-gallery .flex-prev:hover,.post.center-style.format-gallery .flex-next:hover,.post.center-style.format-post-slider .flex-prev:hover,.post.center-style.format-post-slider .flex-next:hover,
        .post.metro-style .info-wrap .category a,
        .post.metro-style.format-video .video-content .play:hover,.post.metro-style.format-post-video .video-content .play:hover,
        .post.metro-style.format-gallery .flex-prev:hover,.post.metro-style.format-gallery .flex-next:hover,.post.metro-style.format-post-slider .flex-prev:hover,.post.metro-style.format-post-slider .flex-next:hover,
        .main-wrapper .col-md-4 .sidebar-item.widget_tag_cloud a,.main-wrapper .col-md-3 .sidebar-item.widget_tag_cloud a,
        .post-details .single-categories a,
        .iframe-video.banner-video.simple .play-button:hover,
        .px-media .iframe-video.banner-video.simple .play-button,
        .a-btn,
        .a-btn-style-1 .wpcf7-form input[type="submit"],
        .protected-page form input[type="submit"],
        .simple_slider .post-media .swiper-pagination-bullet-active,
        .preloader-modern .loader-title::after,
        .headings.bg-animation,
        .urban_slider .slick-current .pagination-category,
        .product-tabs-wrapper .image-wrap .on-new{
        background-color: <?php echo esc_html(cs_get_option('front_color_1')) ?>;
        }

        .a-btn,
        .a-btn:hover,
        .a-btn-style-1 .wpcf7-form input[type="submit"],
        .a-btn-style-1 .wpcf7-form input[type="submit"]:hover,
        .protected-page form input[type="submit"],
        .protected-page form input[type="submit"]:hover,
        .form .your-email input[type="email"],
        .pricing-simple-item.border:after,
        .split-wrapper .wpcf7 textarea:focus,.split-wrapper .wpcf7 input:not([type="submit"]):focus,
        .px-slider.horizontal_2 .px-slider__item--iterator:after,
        .protected-page form input:not([type="submit"]):focus {
        border-color: <?php echo esc_html(cs_get_option('front_color_1')) ?>;
        }

        .a-btn,
        .a-btn-style-1 .wpcf7-form input[type="submit"],
        .protected-page form input[type="submit"] {
        background-image: -webkit-gradient(linear, left top, right top, color-stop(50%, transparent), color-stop(50%, <?php echo esc_html(cs_get_option('front_color_1')) ?>));
        background-image: linear-gradient(to right, transparent 50%, <?php echo esc_html(cs_get_option('front_color_1')) ?> 50%);
        }


        .split-wrapper .wpcf7 textarea:focus,.split-wrapper .wpcf7 input:not([type="submit"]):focus,
        .protected-page form input:not([type="submit"]):focus {
        outline-color: <?php echo esc_html(cs_get_option('front_color_1')) ?>;
        }


    <?php endif;

        /* ======= FRONT COLOR 2 ======= */

        if (cs_get_option('front_color_2') && cs_get_option('front_color_2') !== '#888') : ?>

        body,
        a,a:hover,a:focus,
        .wpb_text_column p,
        .error404 .hero-inner .subtitle,
        .sidebar-item input,
        .col-md-4 .sidebar-item a,.col-md-4 .sidebar-item span,.col-md-4 .sidebar-item p,.col-md-4 .sidebar-item strong,.col-md-3 .sidebar-item a,.col-md-3 .sidebar-item span,.col-md-3 .sidebar-item p,.col-md-3 .sidebar-item strong,
        .col-md-4 .sidebar-item select,.col-md-3 .sidebar-item select,
        .col-md-4 .sidebar-item.widget_rss span.rss-date,.col-md-3 .sidebar-item.widget_rss span.rss-date,
        .sidebar-item span.product-title:hover,
        .simple_gallery .social-list a:hover,
        div.wpcf7-mail-sent-ok,div.wpcf7-validation-errors,div.wpcf7-acceptance-missing,
        .archive-client .user-info-wrap .descr,
        body.single-whizzy_proof_gallery .whizzy-data .grid__item .entry__meta-box span,
        .protected-page form input:not([type="submit"]),
        blockquote cite,
        .simple_gallery .categories a,
        .simple_gallery .text p,
        .simple_gallery .info-item-wrap .text-item,.simple_gallery .info-item-wrap .text-item a,
        .simple_slider .info-wrap .text-item,.simple_slider .info-wrap .text-item a,
        .simple_slider .text-wrap .text,
        .simple_slider .blockquote cite,
        .urban .banner-wrap .excerpt,
        .urban .info-item-wrap .text-item,.urban .info-item-wrap .text-item a,
        .urban .text-wrap .text,
        .urban .blockquote::before,
        .urban .blockquote cite,
        .tile_info .text-gallery-wrap .info-item-wrap .text-item,
        .tile_info .text-gallery-wrap .info-item-wrap .text-item a,
        .tile_info .text-gallery-wrap .text-wrap .text,
        .tile_info .blockquote cite,
        .tile_info .recent-posts-wrapper .subtitle,
        .alia .text-gallery-wrap .info-item-wrap .text-item,.alia .text-gallery-wrap .info-item-wrap a,
        .alia .text-wrap .text p,
        .menio .additional-text,
        .menio .text-wrap p,
        .menio .recent-posts-wrapper .subtitle,
        .parallax-window .content-parallax .text,
        .parallax-window .content-parallax .social-list>li a:hover,
        .parallax-window .content-parallax .info-item-wrap .item .text-item a,.parallax-window .content-parallax .info-item-wrap .item .text-item,
        .portfolio-content-pixxy.left_gallery .info-item-wrap .text-item,
        .portfolio-content-pixxy.left_gallery .info-item-wrap .text-item a,
        .full_slider .social-list a:hover,
        .woocommerce p.price del,.woocommerce .price del,.woocommerce ul.products li.product p.price del,.woocommerce ul.products li.product .price del,.woocommerce div.product p.price del,.woocommerce div.product .price del,
        .pixxy-woocommerce-pagination .nav-links>div.nav-previous:before,.pixxy-woocommerce-pagination .nav-links>div.nav-previous:after,.pixxy-woocommerce-pagination .nav-links>div.nav-next:before,.pixxy-woocommerce-pagination .nav-links>div.nav-next:after,
        .shipping-calculator-button, .woocommerce-tabs ul.tabs.wc-tabs li a,.pixxy_product_detail div.product .woocommerce-tabs ul.tabs.wc-tabs li a,
        .single-product div.product .woocommerce-tabs .woocommerce-Tabs-panel p,.pixxy_product_detail div.product .woocommerce-tabs .woocommerce-Tabs-panel p,
        .single-product .product #reviews #comments .commentlist .comment .comment-text .date_publish,.pixxy_product_detail .product #reviews #comments .commentlist .comment .comment-text .date_publish,
        .single-product .product .woocommerce-Reviews #review_form_wrapper input,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper input,.single-product .product .woocommerce-Reviews #review_form_wrapper textarea,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper textarea,
        .post-little-banner .count-results,
        .post-little-banner.empty-post-list input:not([type="submit"]),
        .post.center-style .date::before,
        .post.center-style .date a,
        .post.center-style.format-quote .info-wrap cite,.post.center-style.format-post-text .info-wrap cite,
        .post.center-style.format-link .link-wrap a:hover,.post.center-style.format-post-link .link-wrap a:hover,
        .post.center-style.format-link .link-wrap i,.post.center-style.format-post-link .link-wrap i,
        .post.metro-style .info-wrap .text p,
        .single-post p,
        .post.metro-style.format-quote .info-wrap i.ion-quote,.post.metro-style.format-post-text .info-wrap i.ion-quote,
        .post.metro-style.format-quote .info-wrap cite,.post.metro-style.format-post-text .info-wrap cite,
        .post.metro-style.format-link .link-wrap i,.post.metro-style.format-post-link .link-wrap i,
        .post.metro-style.format-link .link-wrap a:hover,.post.metro-style.format-post-link .link-wrap a:hover,
        .single-post .single-content blockquote p::before,.post-paper blockquote p::before,
        .single-post dl dd,.comments dl dd,
        .main-wrapper .col-md-4 .sidebar-item .pixxy-widget-about .text,.main-wrapper .col-md-3 .sidebar-item .pixxy-widget-about .text,
        .main-wrapper .col-md-4 .sidebar-item .pixxy-recent-post-widget .recent-date,.main-wrapper .col-md-3 .sidebar-item .pixxy-recent-post-widget .recent-date,
        .sm-wrap-post .content .title:hover,
        .sm-wrap-post .content .excerpt,
        .sm-wrap-post .content .post-date .date,
        .pages,.page-numbers,
        .single-pagination>div,
        .single-pagination>div.pag-prev::before,
        .single-pagination>div.pag-next::after,
        .single-pagination>div a.content:hover,
        .post-details .date-post,.post-details .author,
        .post-details .link-wrap i,
        .post-details ul li,.post-details ol li,
        .post-info .single-tags a,.bottom-infopwrap .single-tags a,.user-info-wrap .single-tags a,.main-top-content .single-tags a,.post-details .link-wrap .single-tags a,
        .post-info .likes-wrap span,.post-info .count,.post-info .post__likes,
        .post-info .social-list a:hover,
        .comments .content .comment-reply-link:hover,
        .comments .content .text,
        .comments .person .author:hover,
        .comments .person .comment-date,
        .unit .post-little-banner+.post-paper.padding-both ul li,.unit .post-little-banner+.post-paper.padding-both ol li,
        .unit.main-wrapper .col-md-3 .sidebar-item li,.unit.main-wrapper .col-md-3 .sidebar-item p,
        .unit .post.metro-style.format-link .date a,.unit .post.metro-style.format-post-link .date a,
        .unit .post.metro-style.format-link .link-wrap i,.unit .post.metro-style.format-post-link .link-wrap i,
        .about-section .description,
        .top-banner.creative .descr,
        .banner-slider-wrap.vertical-2 .text,
        .banner-slider-wrap.andra .swiper-pagination .swiper-pagination-total,
        .banner-slider-wrap.urban .pag-wrapper .swiper-button-next:hover,
        .banner-slider-wrap.urban .pag-wrapper .swiper-button-prev:hover,
        .cta.simple .description,
        .coming-page-wrapper .subtitle,
        .headings .description,
        .info-list .info-item .description,
        .insta-descr,
        .insta-descr a:hover,
        .urban_slider .pagination-title,
        .pricing-simple-label,
        .pricing-simple-lab,
        .pricing-simple-params p,
        .pricing-simple-params p.passive:before,
        .product-slider-wrapper .prod-descr,
        .product-tabs-wrapper .price span,
        .product-tabs-wrapper .price del,
        .product-tabs-wrapper .price del span,
        .skill-wrapper .text,
        .split-wrapper .wpcf7 textarea,.split-wrapper .wpcf7 input:not([type="submit"]),
        .split-wrapper .wpcf7 div.wpcf7-mail-sent-ok,.split-wrapper .wpcf7 div.wpcf7-validation-errors,.split-wrapper .wpcf7 div.wpcf7-acceptance-missing,
        .split-wrapper .wpcf7 span.wpcf7-not-valid-tip,
        .px-testimonial.multiple .description,
        .px-testimonial.multiple_style_2 .description,
        .top-banner .subtitle,
        .counter.with-media .subtitle,
        .headings .subtitle,
        .product-slider-wrapper a.additional-link,
        .skill-wrapper .subtitle,
        #grid-121 .tg-nav-color, #grid-121 .tg-search-icon:hover:before,
        #grid-121 .tg-search-icon:hover input,
        #grid-121 .tg-disabled:hover .tg-icon-left-arrow,
        #grid-121 .tg-disabled:hover .tg-icon-right-arrow,
        #grid-121 .tg-dropdown-title.tg-nav-color:hover,
        .top-banner.simple .descr,
        .top-banner.creative .descr,
        .coming-page-wrapper .form input:not([type="submit"]),.coming-page-wrapper .form textarea,
        .split_slider .split-wrapper .descr,
        .px-testimonial.flipping .position,
        p.cart-empty,
        .woocommerce .single-product div.product p.price,.woocommerce .single-product div.product span.price,.woocommerce ul.products.default li.product .price,.pixxy_cart.shop_table ul .cart_item ul .product-price,.pixxy_cart.shop_table ul .cart_item ul .product-subtotal,#topmenu .pixxy_mini_cart .product_list_widget .mini_cart_item .mini-cart-data .mini_cart_item_price,.woocommerce table.shop_table .cart_item .product-total,
        .woocommerce-account .addresses .title .edit,
        .woocommerce .product-total,.woocommerce .shipped_via,
        .single-product .product .summary .woocommerce-product-rating .woocommerce-review-link,.pixxy_product_detail .product .summary .woocommerce-product-rating .woocommerce-review-link,
        .single-product .product .summary .product_desc p,.pixxy_product_detail .product .summary .product_desc p,
        .single-product .product .summary .variations_form.cart .variations_button span,.single-product .product .summary .variations_form.cart .variations tbody span,.pixxy_product_detail .product .summary .variations_form.cart .variations_button span,.pixxy_product_detail .product .summary .variations_form.cart .variations tbody span,
        .single-product .product .summary .cart .variations .label label,.pixxy_product_detail .product .summary .cart .variations .label label,
        .single-product .product .summary .cart .variations .value ul li p,.pixxy_product_detail .product .summary .cart .variations .value ul li p,
        .single-product .product .summary .product_meta,.pixxy_product_detail .product .summary .product_meta,
        .single-product .product .summary .product_meta a,.pixxy_product_detail .product .summary .product_meta a,
        .single-product .product .summary .product_meta .sku_wrapper .sku,.pixxy_product_detail .product .summary .product_meta .sku_wrapper .sku,
        .single-product .product .summary .variations_form.cart .variations .value select,.pixxy_product_detail .product .summary .variations_form.cart .variations .value select,
        .pixxy_cart.shop_table ul .cart_item ul .product-price,.pixxy_cart.shop_table ul .cart_item ul .product-subtotal,
        .pixxy-cart-collaterals .cart_totals .shop_table ul li span.price-value,
        .select2-search input,
        .select2-results li,
        .woocommerce table.shop_table .cart_item .product-name strong,
        .woocommerce table.shop_table .cart_item .product-name .variation dd p,
        .woocommerce table.shop_table tfoot .cart-subtotal td .woocommerce-Price-amount,.woocommerce table.shop_table tfoot .shipping td .woocommerce-Price-amount,
        .woocommerce-checkout-review-order #payment .payment_methods.methods li,
        .woocommerce-checkout-review-order #payment .payment_methods.methods li .about_paypal,
        .widget_price_filter .price_slider_amount .button:hover,
        .widget_price_filter .price_label,
        .pixxy-best-seller-widget .swiper-button-prev,.pixxy-best-seller-widget .swiper-button-next,
        .pixxy-best-seller-widget .seller-price,.pixxy-sorting-products-widget .woocommerce-ordering::after,
        .pixxy-sorting-products-widget .woocommerce-ordering select,
        .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a,
        .woocommerce-MyAccount-content a,
        .woocommerce-MyAccount-content address,
        .pixxy-shop-banner .pixxy-shop-menu ul li,
        .pixxy-shop-banner .pixxy-shop-menu ul li a:hover,
        .woocommerce ul,.woocommerce-MyAccount-content p,
        .SocialLinkWidget .pixxy-widget-social-link a:hover,
        .widget_product_categories .product-categories a,
        .px-testimonial .social>a>i,
        .product-tabs-wrapper .filters ul li span,
        .discount__content .subtitle,
        .text-light .monospace,
        .urban .social-list a,
        .tile_info .social-list a,
        .alia .social-list a,
        .menio .social-list a,
        .urban_slider .pagination-title,
        .single-pagination .icon-wrap i,
        .woocommerce ul.products li.product,
        .post-info span a,.post-info span,
        .post.center-style.format-link .date a,.post.center-style.format-post-link .date a,
        .monospace,
        .pixxy_cart.shop_table ul .cart_item ul .product-name .variation dd p,
        .main-wrapper .col-md-4 .sidebar-item .cat-item.current-cat a,.main-wrapper .col-md-3 .sidebar-item .cat-item.current-cat a {
        color: <?php echo esc_html(cs_get_option('front_color_2')) ?>;
        }

        .post-nav a span,
        .pixxy_cart.shop_table ul .cart_item ul .product-remove .remove,
        .woocommerce-page.woocommerce .sidebar-item.widget_shopping_cart a:hover,
        .woocommerce a.remove:hover {
        color: <?php echo esc_html(cs_get_option('front_color_2')) ?> !important;
        }

        table,th,td,
        .select2-search input,
        .select2-container.select2-dropdown-open.select2-drop-above .select2-choice,
        .woocommerce form.checkout_coupon .form-row input.input-text::focus,
        .pages,.page-numbers,
        .post-nav .pages:hover,
        .pricing-simple-lab,
        .urban .social-list a,
        .tile_info .social-list a,
        .alia .text-gallery-wrap .info-item-wrap .name,
        .alia .social-list a,
        .menio .social-list a,
        .single-product .product .summary .variations_form.cart .variations .value select,.pixxy_product_detail .product .summary .variations_form.cart .variations .value select,
        .single-product .product .pixxy-shop-info-title,.pixxy_product_detail .product .pixxy-shop-info-title,
        .single-product .product .woocommerce-tabs .tabs.wc-tabs:before,.pixxy_product_detail .product .woocommerce-tabs .tabs.wc-tabs:before,
        .pixxy_cart.shop_table .heading,
        .pixxy_cart.shop_table ul .cart_item,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text,.woocommerce form .form-row select,.woocommerce form .form-row input,
        .woocommerce form.checkout_coupon .form-row input.input-text,
        .woocommerce form .form-row.woocommerce-validated .select2-container,.woocommerce form .form-row.woocommerce-invalid .select2-container,
        .woocommerce table.shop_table tfoot,
        .SocialLinkWidget .pixxy-widget-social-title,
        .select2-container,
        .single-product .product .summary .cart .variations .value fieldset,.pixxy_product_detail .product .summary .cart .variations .value fieldset,
        .post-info .single-tags a,.bottom-infopwrap .single-tags a,.user-info-wrap .single-tags a,.main-top-content .single-tags a,.post-details .link-wrap .single-tags a,
        .error404 .main-wrapper.unit .a-btn-4:hover,
        .sidebar-item input,
        .protected-page form input:not([type="submit"]),
        .single-product .product .woocommerce-Reviews #review_form_wrapper input,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper input,.single-product .product .woocommerce-Reviews #review_form_wrapper textarea,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper textarea,
        .woocommerce form.login .form-row input[type="submit"]:focus:hover,.woocommerce form.login .form-row input[type="submit"]:visited:hover,.woocommerce form.login .form-row input[type="submit"]:active:hover,.woocommerce form.login .form-row input[type="submit"]:hover,
        .woocommerce form.login .form-row input[type="submit"]:focus:hover,.woocommerce form.login .form-row input[type="submit"]:visited:hover,.woocommerce form.login .form-row input[type="submit"]:active:hover,.woocommerce form.login .form-row input[type="submit"]:hover,
        .post-little-banner.empty-post-list input[type="submit"]:hover,
        #contactform textarea,#contactform input:not([type="submit"]),.comments-form textarea,.comments-form input:not([type="submit"]),
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .comment-title,
        .single-post .single-content .swiper-container,
        .spinner-preloader-wrap .cssload-container .cssload-moon {
        border-color: <?php echo esc_html(cs_get_option('front_color_2')) ?>;
        }

        .lg-outer .lg-thumb-item.active,.lg-outer .lg-thumb-item:hover,
        .post-nav a span {
        border-color: <?php echo esc_html(cs_get_option('front_color_2')) ?> !important;
        }

        .urban_slider .pagination-category {
        background: <?php echo esc_html(cs_get_option('front_color_2')) ?>;
        }

        @media (max-width: 991px) {
        .headings .title--delimiter:after {
        background-color: <?php echo esc_html(cs_get_option('front_color_2')) ?>;
        }
        }


    <?php endif;

        /* ======= FRONT COLOR 3 ======= */

        if (cs_get_option('front_color_3') && cs_get_option('front_color_3') !== '#222') : ?>

        h1,h2,h3,h4,h5,h6,
        .single-post h1,.single-post h2,.single-post h3,.single-post h4,.single-post h5,.single-post h6,
        .text-dark,
        .preloader-modern .loader-title,
        .a-btn-2:hover,
        .a-btn-3,
        .a-btn-3:focus,
        .a-btn-4,
        .a-btn-4:focus,
        .a-btn-5:hover,
        .a-btn-style-2 .wpcf7-form input[type="submit"]:hover,
        .a-btn-style-3 .wpcf7-form input[type="submit"],
        .a-btn-style-3 .wpcf7-form input[type="submit"]:focus,
        .a-btn-style-4 .wpcf7-form input[type="submit"],
        .a-btn-style-4 .wpcf7-form input[type="submit"]:focus,
        .a-btn-style-5 .wpcf7-form input[type="submit"]:hover,
        code,
        kbd,
        caption,
        .wpb_text_column h1,.wpb_text_column h2,.wpb_text_column h3,.wpb_text_column h4,.wpb_text_column h5,.wpb_text_column h6,
        .error404 .main-wrapper.unit .a-btn-4:hover,
        .error404 .hero-inner .bigtext,
        .error404 .hero-inner .title,
        .error404 .main-wrapper.unit .bigtext,.error404 .main-wrapper.unit .subtitle,.error404 .main-wrapper.unit .title,
        .sidebar-item ul li a,
        .sidebar-item input:focus,
        .col-md-4 .sidebar-item .recentcomments a,.col-md-3 .sidebar-item .recentcomments a,
        .col-md-4 .sidebar-item li,.col-md-3 .sidebar-item li,
        .col-md-4 .sidebar-item.widget_rss h5 a,.col-md-3 .sidebar-item.widget_rss h5 a,
        .col-md-4 .sidebar-item.widget_rss a.rsswidget,.col-md-3 .sidebar-item.widget_rss a.rsswidget,
        .col-md-4 .sidebar-item.widget_rss cite,.col-md-3 .sidebar-item.widget_rss cite,
        .col-md-3 .ContactWidget .contact_url,.col-md-3 .ContactWidget div.contact_content,.col-md-3 .ContactWidget a.fa,.col-md-3 .pixxyInstagramWidget,.col-md-4 .ContactWidget .contact_url,.col-md-4 .ContactWidget div.contact_content,.col-md-4 .ContactWidget a.fa,.col-md-4 .pixxyInstagramWidget,
        .widget_product_search form::after,.widget_search form div::after,
        .sidebar-item span.product-title,
        .simple_gallery .social-list a,
        dt,
        .unit strong,.unit b,
        .no-menu>a,
        .simple_gallery .flex-prev,.simple_gallery .flex-next,
        .simple_gallery .flex-prev:hover i,.simple_gallery .flex-next:hover i,
        .simple_gallery .categories a:hover,
        .simple_gallery .info-item-wrap .name,
        .simple_gallery .info-item-wrap .text-item a:hover,
        .simple_slider .info-wrap .date,
        .simple_slider .info-wrap .name,
        .simple_slider .info-wrap .text-item a:hover,
        .simple_slider .info-wrap a:hover,
        .simple_slider .info-wrap .social-list a,
        .simple_slider .blockquote,
        .urban .info-item-wrap .name,
        .urban .info-item-wrap .text-item a:hover,
        .urban .info-item-wrap a:hover,
        .tile_info .text-gallery-wrap .info-item-wrap .name,
        .tile_info .text-gallery-wrap .info-item-wrap .text-item a:hover,
        .tile_info .text-gallery-wrap .info-item-wrap a:hover,
        .tile_info .recent-posts-wrapper .title,
        .menio .recent-posts-wrapper .title,
        .tile_info .blockquote,
        .alia .text-gallery-wrap .additional-text,
        .alia .text-gallery-wrap .info-item-wrap .name,
        .alia .text-gallery-wrap .info-item-wrap a:hover,
        .alia .text-wrap .title-for-text,
        .menio .blockquote,
        .tg-item .tg-item-inner .main-color,
        .parallax-window .content-parallax .category-parallax a:hover,
        .parallax-window .content-parallax .social-list>li a,
        .parallax-window .content-parallax .info-item-wrap .item .name,
        .parallax-window .content-parallax .info-item-wrap .item .text-item a:hover,
        .portfolio-content-pixxy.left_gallery .info-item-wrap .name,
        .portfolio-content-pixxy.left_gallery .info-item-wrap .text-item a:hover,
        .portfolio-content-pixxy.left_gallery .social-list a,
        .urban_slider .slick-arrow,
        .parallax-window .content-parallax .title,
        .urban_slider .slick-current .pagination-title,
        .full_slider .social-list a,
        .pixxy-shop-main-banner .pixxy-shop-title,
        .woocommerce p.price,.woocommerce .price,.woocommerce ul.products li.product p.price,.woocommerce ul.products li.product .price,.woocommerce div.product p.price,.woocommerce div.product .price,e div.product .price ins,
        .woocommerce ul.products li.product .pixxy-prod-list-image .pixxy-link,
        .woocommerce ul.products li.product .pixxy-prod-list-image .pixxy-add-to-cart a:hover,tion .nav-links>div.nav-next a,
        .pixxy-woocommerce-pagination .nav-links>div.nav-previous:hover:before,.pixxy-woocommerce-pagination .nav-links>div.nav-previous:hover:after,.pixxy-woocommerce-pagination .nav-links>div.nav-next:hover:before,.pixxy-woocommerce-pagination .nav-links>div.nav-next:hover:after,
        .pixxy_product_detail .product .pixxy_images figure+.on-new,.pixxy_product_detail .product .pixxy_images figure+.onsale,.single-product .product .pixxy_images figure+.on-new,.single-product .product .pixxy_images figure+.onsale,
        .pixxy_product_detail .product .pixxy_images a .on-new,.pixxy_product_detail .product .pixxy_images a .onsale,.single-product .product .pixxy_images a .on-new,.single-product .product .pixxy_images a .onsale,
        .single-product div.product .up-sells>h2,.pixxy_product_detail div.product .up-sells>h2,.single-product .product .related.products>h2,.pixxy_product_detail .product .related.products>h2,
        .woocommerce div.product form.cart .button:hover,
        .woocommerce .pixxy_product_detail div.product .price,
        .woocommerce .single-product .star-rating,.woocommerce .pixxy_product_detail .star-rating,
        .woocommerce .single-product .star-rating:before,.woocommerce .pixxy_product_detail .star-rating:before,
        .woocommerce .quantity .qty,
        .woocommerce-page.woocommerce-cart .woocommerce input.button:hover,.woocommerce-page.woocommerce-checkout .woocommerce input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce a.button.alt:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,
        .woocommerce-account .single-post p,.woocommerce-account .single-post strong,
        .woocommerce .woocommerce-thankyou-order-received,
        .woocommerce table.shop_table tfoot td,
        .woocommerce .product-name a,
        .product-gallery-wrap .on-new,
        .pixxy_product_detail .social-list a,
        .single-product .product .summary .product_title,.pixxy_product_detail .product .summary .product_title,
        .single-product .product .summary .cart .group_table td.label,.pixxy_product_detail .product .summary .cart .group_table td.label,
        .single-product .product .summary .cart .variations .value ul li label,.pixxy_product_detail .product .summary .cart .variations .value ul li label,
        .single-product .product .pixxy-shop-info-title,.pixxy_product_detail .product .pixxy-shop-info-title,
        .single-product .product .summary .product_meta .posted_in a:hover,.pixxy_product_detail .product .summary .product_meta .posted_in a:hover,
        .single-product .product .summary .product_meta .tagged_as a:hover,.pixxy_product_detail .product .summary .product_meta .tagged_as a:hover,
        .single-product div.product .woocommerce-tabs ul.tabs.wc-tabs li.active a,.pixxy_product_detail div.product .woocommerce-tabs ul.tabs.wc-tabs li.active a,
        .single-product div.product .woocommerce-tabs .woocommerce-Tabs-panel h2,.pixxy_product_detail div.product .woocommerce-tabs .woocommerce-Tabs-panel h2,
        .single-product div.product .woocommerce-tabs .woocommerce-Tabs-panel table th,.pixxy_product_detail div.product .woocommerce-tabs .woocommerce-Tabs-panel table th,.single-product div.product .woocommerce-tabs .woocommerce-Tabs-panel table td,.pixxy_product_detail div.product .woocommerce-tabs .woocommerce-Tabs-panel table td,
        .single-product .product #reviews #comments .commentlist .comment .comment-text .meta,.pixxy_product_detail .product #reviews #comments .commentlist .comment .comment-text .meta,
        .single-product .product #reviews #comments .commentlist .comment .comment-text .description,.pixxy_product_detail .product #reviews #comments .commentlist .comment .comment-text .description,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-reply-title,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-reply-title,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form-rating label,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form-rating label,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form-rating .stars a,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form-rating .stars a,
        .single-product .product .woocommerce-Reviews #review_form_wrapper input:focus,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper input:focus,.single-product .product .woocommerce-Reviews #review_form_wrapper textarea:focus,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper textarea:focus,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit:hover,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit:hover,
        .single-product .product div.related.products .related-subtitle,.pixxy_product_detail .product div.related.products .related-subtitle,
        .woocommerce ul.products li.product h3,
        .pixxy_cart.shop_table .heading li,
        .pixxy_cart.shop_table ul .cart_item ul .product-name a,
        .pixxy_cart.shop_table ul .cart_item ul .product-name .variation dt,
        #ship-to-different-address label,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text,.woocommerce form .form-row select,.woocommerce form .form-row input,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text:focus,.woocommerce form .form-row select:focus,.woocommerce form .form-row input:focus,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text.button:hover,.woocommerce form .form-row select.button:hover,.woocommerce form .form-row input.button:hover,
        .woocommerce form .form-row select,
        .pixxy-cart-collaterals .cart_totals h2,
        .pixxy-cart-collaterals .cart_totals .shop_table ul li,
        .pixxy-cart-collaterals .cart_totals .shop_table ul li span,
        .woocommerce ul.products li.product .on-new,.woocommerce ul.products li.product .onsale,
        .woocommerce form.checkout_coupon .form-row input.input-text,
        .woocommerce form.checkout h3,row label,.woocommerce form.checkout .form-row label,.woocommerce form.edit-account .form-row label,.woocommerce form.lost_reset_password .form-row label,
        .woocommerce form.login .form-row input,.woocommerce form.login .form-row textarea,.woocommerce form.checkout .form-row input,.woocommerce form.checkout .form-row textarea,
        .woocommerce form.login .form-row input:focus,.woocommerce form.login .form-row textarea:focus,.woocommerce form.checkout .form-row input:focus,.woocommerce form.checkout .form-row textarea:focus,
        .select2-container--default .select2-selection--single .select2-selection__rendered,
        .woocommerce form.login .form-row input[type="submit"]:focus:hover,.woocommerce form.login .form-row input[type="submit"]:visited:hover,.woocommerce form.login .form-row input[type="submit"]:active:hover,.woocommerce form.login .form-row input[type="submit"]:hover,
        .woocommerce form.login .lost_password a,
        .select2-container,
        .select2-drop-active,
        .select2-search:after,
        .select2-results li.select2-highlighted,
        .woocommerce table.shop_table thead .product-name,.woocommerce table.shop_table thead .product-total,
        .woocommerce table.shop_table .cart_item .product-name,
        .woocommerce table.shop_table .cart_item .product-name .variation dt,
        .woocommerce table.shop_table tfoot .cart-subtotal th,.woocommerce table.shop_table tfoot .shipping th,
        .woocommerce table.shop_table .order-total th,
        .woocommerce table.shop_table .order-total .woocommerce-Price-amount,
        .woocommerce-checkout-review-order #payment .payment_methods.methods li label,
        .woocommerce-checkout-review-order #payment div.payment_box,
        .widget_price_filter .price_slider_amount .button,
        .sidebar-item .star-rating span,
        .pixxy-best-seller-widget .swiper-button-prev:hover,.pixxy-best-seller-widget .swiper-button-next:hover,
        .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a:hover,
        .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active a,
        .pixxy-best-seller-widget .seller-text a,
        .woocommerce-MyAccount-content a:hover,
        .woocommerce-MyAccount-content legend,
        .pixxy-shop-banner .pixxy-shop-title,
        .woocommerce form.login .form-row input[type="submit"]:focus:hover,.woocommerce form.login .form-row input[type="submit"]:visited:hover,.woocommerce form.login .form-row input[type="submit"]:active:hover,.woocommerce form.login .form-row input[type="submit"]:hover,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a:hover,
        .woocommerce .woocommerce-message a.button:hover,.woocommerce .woocommerce-info a.button:hover,.woocommerce .woocommerce-error a.button:hover,
        .SocialLinkWidget .pixxy-widget-social-title,
        .SocialLinkWidget .pixxy-widget-social-link a,
        .woocommerce-page .unit .woocommerce a.button:hover,
        .post-little-banner .page-title-blog,
        .post-little-banner.empty-post-list h3,
        .post-little-banner.empty-post-list input[type="submit"]:hover,
        .post-little-banner.empty-post-list input:not([type="submit"]):focus,
        .post-media .video-content .play,
        .post.center-style .category a:hover,
        .post.center-style .date a:hover,
        .post.center-style .title,
        .post.center-style.format-quote .info-wrap blockquote,.post.center-style.format-post-text .info-wrap blockquote,
        .post.center-style.format-gallery .flex-prev,.post.center-style.format-gallery .flex-next,.post.center-style.format-post-slider .flex-prev,.post.center-style.format-post-slider .flex-next,
        .post.metro-style .info-wrap .date a,
        .post.metro-style .info-wrap .title,
        .post.metro-style .info-wrap .counters span,.post.metro-style .info-wrap .counters .count,
        .post.metro-style.format-gallery .flex-prev,.post.metro-style.format-gallery .flex-next,.post.metro-style.format-post-slider .flex-prev,.post.metro-style.format-post-slider .flex-next,
        .post.metro-style.format-video .video-content .play,.post.metro-style.format-post-video .video-content .play,
        .post.metro-style.format-quote i.fa,.post.metro-style.format-post-text i.fa,
        .post.metro-style.format-quote .info-wrap blockquote,.post.metro-style.format-post-text .info-wrap blockquote,
        .metro-load-more .metro-load-more__button,
        .single-post .title,
        .single-post .single-content .swiper-container .description,
        .single-post .single-content .swiper-arrow-right,.single-post ,
        .single-post .single-content .img-slider .flex-prev,.single-post .single-content .img-slider .flex-next,
        .single-post .single-content .img-slider .flex-prev:hover i,.single-post .single-content .img-slider .flex-next:hover i,
        .post-little-banner .main-top-content>*,
        .main-wrapper .col-md-4 .sidebar-item li,.main-wrapper .col-md-4 .sidebar-item p,.main-wrapper .col-md-3 .sidebar-item li,.main-wrapper .col-md-3 .sidebar-item p,
        .main-wrapper .col-md-4 .sidebar-item h1,.main-wrapper .col-md-4 .sidebar-item h2,.main-wrapper .col-md-4 .sidebar-item h3,.main-wrapper .col-md-4 .sidebar-item h4,.main-wrapper .col-md-4 .sidebar-item h5,.main-wrapper .col-md-4 .sidebar-item h6,.main-wrapper .col-md-4 .sidebar-item strong,.main-wrapper .col-md-3 .sidebar-item h1,.main-wrapper .col-md-3 .sidebar-item h2,.main-wrapper .col-md-3 .sidebar-item h3,.main-wrapper .col-md-3 .sidebar-item h4,.main-wrapper .col-md-3 .sidebar-item h5,.main-wrapper .col-md-3 .sidebar-item h6,.main-wrapper .col-md-3 .sidebar-item strong,
        .main-wrapper .col-md-4 .sidebar-item table,.main-wrapper .col-md-3 .sidebar-item table,
        .main-wrapper .col-md-4 .sidebar-item table th,.main-wrapper .col-md-4 .sidebar-item table a,.main-wrapper .col-md-3 .sidebar-item table th,.main-wrapper .col-md-3 .sidebar-item table a,
        .main-wrapper .col-md-4 .sidebar-item table caption,.main-wrapper .col-md-3 .sidebar-item table caption,
        .main-wrapper .col-md-4 .sidebar-item .pixxy-recent-post-widget .recent-text a,.main-wrapper .col-md-3 .sidebar-item .pixxy-recent-post-widget .recent-text a,
        .unit table th,
        .recent-post-single .recent-title,
        .sm-wrap-post .content .title,
        .pagination.cs-pager .page-numbers.next:after,
        .pagination.cs-pager .page-numbers.prev:after,
        .page-numbers:hover,.page-numbers:focus,
        .post-nav .pages,.post-nav .current,.pager-pagination .pages,.pager-pagination .current,
        .post-details .link-wrap a,
        .single-pagination>div.pag-prev:hover::before,
        .single-pagination>div.pag-next:hover::after,
        .single-pagination>div a.content,
        .post-info .likes-wrap .post__likes::before,
        .post-info .social-list a,
        .user-info-wrap .post-author__title,
        .user-info-wrap .post-author__nicename,
        .user-info-wrap .post-author__social a,
        .single-content.no-thumb .main-top-content .title,
        .post-info span.author,
        .post-info span.author a,
        .comments .content .comment-reply-link,
        .comments .comment-reply-title,
        .comments .content .text h1,.comments .content .text h2,.comments .content .text h3,.comments .content .text h4,.comments .content .text h5,.comments .content .text h6,
        .comments .content .text table th,
        .comments .person .author,
        .comments .comments-title,.comments .comments-title span,
        #contactform h3,.comments-form h3,
        #contactform #submit:hover,.comments-form #submit:hover,
        .comment-form label,.comments.main label,
        .unit .single-post pre,.unit .single-content pre,
        .unit .single-post a,.unit .single-content a,
        .unit .single-post ul:not(.comments):not(.children) li::before,.unit .single-content ul:not(.comments):not(.children) li::before,
        .unit .post-paper pre,
        .post-details .date-post span,.post-details .date-post a,.post-details .author span,.post-details .author a,
        .main-album-anim-wrap,
        .main-album-anim-wrap .content--layout-1 .album-text-wrap .content__subtitle,
        .main-album-anim-wrap .content--layout-1 .album-text-wrap .content__title,
        .main-album-anim-wrap .content__title,
        .main-album-anim-wrap .content__desc,
        .banner-slider-wrap.vertical-2 .subtitle,
        .banner-slider-wrap.vertical-2 .title,
        .banner-slider-wrap.vertical-2 .swiper-pagination,
        .banner-slider-wrap.andra .swiper-pagination span,
        .cta.simple .cta-title,
        .cta.with_images .cta-title,
        .coming-page-wrapper .form input:not([type="submit"]):focus,.coming-page-wrapper .form textarea:focus,
        .coming-page-wrapper .title,
        .coming-page-wrapper div.wpcf7-mail-sent-ok,.coming-page-wrapper div.wpcf7-validation-errors,.coming-page-wrapper div.wpcf7-acceptance-missing,
        .coming-page-wrapper span.wpcf7-not-valid-tip,
        .coming-soon-descr,
        .counter.with-media .title,
        .iframe-video.banner-video.simple .play-button,
        .headings .title,
        .info-list .info-item .title,
        .last-posts .post-item__head .title>a,
        .last-post-button a,
        .line-icons-wrap .icons-item,
        .urban_slider .slick-arrow,
        .urban_slider .slick-current .pagination-title,
        .split_slider .split-wrapper .title a,
        .pricing .title,
        .pricing .pricing-item-price,
        .pricing .pricing-tab-item.active a,
        .pricing-simple-title,
        .product-tabs-wrapper .filters ul,
        .product-tabs-wrapper .title,
        .product-slider-wrapper .btn-wrap.dark>a:hover,
        .product-slider-wrapper .socials,
        .product-slider-wrapper .swiper-pagination,
        .product-tabs-wrapper .image-wrap .product-links-wrapp,
        .product-tabs-wrapper .image-wrap .product-links-wrapp .pixxy-link:before,
        .product-tabs-wrapper .image-wrap .product-links-wrapp .pixxy-add-to-cart a:before,
        .px-testimonial.full_width [class^="swiper-button"],
        .skills .skill,
        .skill-wrapper .title,
        .px-testimonial.full_width .user-info .name,
        .px-testimonial.multiple .user .name,.px-testimonial.multiple_style_2 .user .name,
        .px-testimonial.flipping .name,
        .px-testimonial.flipping .flipto:before,
        .iframe-video.banner-video.simple .play-button {
        color: <?php echo esc_html(cs_get_option('front_color_3')) ?>
        }

        .woocommerce form.checkout_coupon .form-row input.input-text:-webkit-input-placeholder,
        .woocommerce form.checkout_coupon .form-row input.input-text:-moz-placeholder,
        .woocommerce form.checkout_coupon .form-row input.input-text:-ms-input-placeholder,
        .woocommerce form.checkout_coupon .form-row input.input-text:-moz-placeholder,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text:-webkit-input-placeholder,
        .woocommerce form .form-row select:-webkit-input-placeholder,.woocommerce form .form-row input:-webkit-input-placeholder,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text:-moz-placeholder,
        .woocommerce form .form-row select:-moz-placeholder,.woocommerce form .form-row input:-moz-placeholder,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text:-ms-input-placeholder,
        .woocommerce form .form-row select:-ms-input-placeholder,.woocommerce form .form-row input:-ms-input-placeholder,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text:-moz-placeholder,
        .woocommerce form .form-row select:-moz-placeholder,.woocommerce form .form-row input:-moz-placeholder,
        .woocommerce form.login .form-row input:-webkit-input-placeholder,.woocommerce form.login .form-row textarea:-webkit-input-placeholder,.woocommerce form.checkout .form-row input:-webkit-input-placeholder,.woocommerce form.checkout .form-row textarea:-webkit-input-placeholder,
        .woocommerce form.login .form-row input:-moz-placeholder,.woocommerce form.login .form-row textarea:-moz-placeholder,.woocommerce form.checkout .form-row input:-moz-placeholder,.woocommerce form.checkout .form-row textarea:-moz-placeholder,
        .woocommerce form.login .form-row input:-ms-input-placeholder,.woocommerce form.login .form-row textarea:-ms-input-placeholder,.woocommerce form.checkout .form-row input:-ms-input-placeholder,.woocommerce form.checkout .form-row textarea:-ms-input-placeholder,
        .woocommerce form.login .form-row input:-moz-placeholder,.woocommerce form.login .form-row textarea:-moz-placeholder,.woocommerce form.checkout .form-row input:-moz-placeholder,.woocommerce form.checkout .form-row textarea:-moz-placeholder,
        #contactform textarea::-moz-placeholder,#contactform input::-moz-placeholder,.comments-form textarea::-moz-placeholder,.comments-form input::-moz-placeholder {
        color: <?php echo esc_html(cs_get_option('front_color_3')) ?>
        }

        .pixxy_cart.shop_table ul .cart_item ul .product-remove .remove:hover,
        .woocommerce-page.woocommerce .sidebar-item.widget_shopping_cart a,
        .woocommerce-page.woocommerce .sidebar-item.widget_shopping_cart a.button:hover,
        .woocommerce .sidebar-item a.remove,
        .widget_product_categories .product-categories a:hover,
        .post-nav a span:hover {
        color: <?php echo esc_html(cs_get_option('front_color_3')) ?> !important;
        }

        .px-accordion__item-title:before,
        .px-accordion__item-title:after,
        .top-banner.classic .title:before,
        .px-slider.horizontal_2 .swiper-pagination-bullet-active,
        .px-slider .swiper-pagination-bullet{
        background: <?php echo esc_html(cs_get_option('front_color_3')) ?>;
        }

        .urban_slider .slick-arrow:hover,
        .product-tabs-wrapper .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
        #multiscroll-nav a,
        .skills .line .active-line,
        button,html input[type=button],
        input[type=reset],
        input[type=submit],
        .ri-grid ul li,
        .flex-control-paging li a.flex-active {
        background: <?php echo esc_html(cs_get_option('front_color_3')) ?>
        }


        .woocommerce ul.products li.product .pixxy_product_list_name .count,
        .post.center-style.format-link .info-wrap,.post.center-style.format-post-link .info-wrap,
        .post.metro-style.format-link .post-wrap-item,.post.metro-style.format-post-link .post-wrap-item,
        .post.metro-style.format-link .info-wrap,.post.metro-style.format-post-link .info-wrap,
        .post-info span a,
        .col-md-4 .widget_tag_cloud a,.col-md-3 .widget_tag_cloud a,
        .archive-client .user-info-wrap .title:before,
        .simple_gallery .flex-prev,.simple_gallery .flex-next,
        .simple_slider .post-media .swiper-pagination-bullet,
        .urban_slider .slick-arrow:hover,
        .portfolio-content-pixxy.full_slider .swiper-pagination .swiper-pagination-bullet,
        .a-btn-2,
        .a-btn-style-2 .wpcf7-form input[type="submit"],
        .error404 .main-wrapper.unit .a-btn-4,
        .woocommerce ul.products li.product .pixxy-prod-list-image .pixxy-add-to-cart a,
        .woocommerce div.product form.cart .button,
        .woocommerce-page.woocommerce-cart .woocommerce input.button,.woocommerce-page.woocommerce-checkout .woocommerce input.button,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce a.button.alt,.woocommerce button.button,.woocommerce input.button,
        .single-product .product .summary .cart .variations .value ul li input:checked+label:before,.pixxy_product_detail .product .summary .cart .variations .value ul li input:checked+label:before,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,
        .woocommerce form.login .form-row input[type="submit"]:focus,.woocommerce form.login .form-row input[type="submit"]:visited,.woocommerce form.login .form-row input[type="submit"]:active,.woocommerce form.login .form-row input[type="submit"],
        .woocommerce form.login .form-row input[type="checkbox"]:checked+label.checkbox:before,.woocommerce form.checkout .form-row input[type="checkbox"]:checked+label.checkbox:before,.woocommerce .woocommerce-shipping-fields input[type="checkbox"]:checked+label.checkbox:before,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .woocommerce form.login .form-row input[type="submit"]:focus,.woocommerce form.login .form-row input[type="submit"]:visited,.woocommerce form.login .form-row input[type="submit"]:active,.woocommerce form.login .form-row input[type="submit"],
        .woocommerce .woocommerce-message,.woocommerce .woocommerce-info,.woocommerce .woocommerce-error,
        .post-little-banner.empty-post-list input[type="submit"],
        .post.center-style.format-gallery .flex-prev,.post.center-style.format-gallery .flex-next,.post.center-style.format-post-slider .flex-prev,.post.center-style.format-post-slider .flex-next,
        .post-paper.masonry .post.metro-style.format-gallery .flex-prev:not(:hover),.post-paper.masonry .post.metro-style.format-gallery .flex-next:not(:hover),.post-paper.masonry .post.metro-style.format-post-slider .flex-prev:not(:hover),.post-paper.masonry .post.metro-style.format-post-slider .flex-next:not(:hover),.post-paper.masonry .post.metro-style.format-video .video-content .play:not(:hover),.post-paper.masonry .post.metro-style.format-post-video .video-content .play:not(:hover),
        .single-post .single-content .img-slider .flex-prev,.single-post .single-content .img-slider .flex-next,
        .main-wrapper .col-md-4 .sidebar-item.widget_tag_cloud a:hover,.main-wrapper .col-md-3 .sidebar-item.widget_tag_cloud a:hover,
        .post-info .single-tags a:hover,.bottom-infopwrap .single-tags a:hover,.user-info-wrap .single-tags a:hover,.main-top-content .single-tags a:hover,.post-details .link-wrap .single-tags a:hover,
        #contactform #submit,.comments-form #submit,
        .black,
        .highlight,
        .blog .mfp-fade.mfp-bg.mfp-ready,
        .archive .mfp-fade.mfp-bg.mfp-ready,
        .single-post .mfp-fade.mfp-bg.mfp-ready,
        .toggle-title:after,
        .pagination a.img,
        .mfp-fade.mfp-bg.mfp-ready,
        .px-testimonial.full_width .swiper-pagination .swiper-pagination-bullet-active,
        .px-testimonial.multiple_style_2 .swiper-pagination-bullet-active,
        .animsition-loading:before,
        .ri-grid ul li a,
        .post>.post-wrap-item {
        background-color: <?php echo esc_html(cs_get_option('front_color_3')) ?>
        }

        .pricing .pricing-tab-item a {
        color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.4) ?>;
        }

        .post.center-style.format-quote .info-wrap i,.post.center-style.format-post-text .info-wrap i {
        color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.2) ?>;
        }

        .product-tabs-wrapper .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active::before,
        .product-slider-wrapper .btn-wrap.dark>a,
        .a-btn-2,
        .a-btn-3,
        .a-btn-style-2 .wpcf7-form input[type="submit"],
        .a-btn-style-3 .wpcf7-form input[type="submit"],
        button,html input[type=button],input[type=reset],input[type=submit],
        .error404 .main-wrapper.unit .a-btn-4,
        .sidebar-item input:focus,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text:focus,.woocommerce form .form-row select:focus,.woocommerce form .form-row input:focus,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,
        .woocommerce .quantity .qty,
        .woocommerce form .form-r,
        .woocommerce-page.wooc,
        .single-product div.p,
        .single-product .pro,
        .woocommerce form.login .form-row input[type="submit"]:focus,.woocommerce form.login .form-row input[type="submit"]:visited,.woocommerce form.login .form-row input[type="submit"]:active,.woocommerce form.login .form-row input[type="submit"],
        .woocommerce form.login .form-row input:focus,.woocommerce form.login .form-row textarea:focus,.woocommerce form.checkout .form-row input:focus,.woocommerce form.checkout .form-row textarea:focus,
        .pixxy-sorting-products-widget .woocommerce-ordering select,
        .woocommerce form.login .form-row input[type="submit"]:focus,.woocommerce form.login .form-row input[type="submit"]:visited,.woocommerce form.login .form-row input[type="submit"]:active,.woocommerce form.login .form-row input[type="submit"],
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,
        .woocommerce ul.products li.product .pixxy-prod-list-image .pixxy-add-to-cart a,
        .woocommerce div.product form.cart .button,
        .select2-drop-active,
        .woocommerce .woocommerce-message,.woocommerce .woocommerce-info,.woocommerce .woocommerce-error,
        .post-little-banner.empty-post-list input[type="submit"],
        .post-little-banner.empty-post-list input:not([type="submit"]),
        .page-numbers:hover,.page-numbers:focus,
        .post-nav .pages,.post-nav .current,.pager-pagination .pages,.pager-pagination .current,
        .post-info .single-tags a:hover,.bottom-infopwrap .single-tags a:hover,.user-info-wrap .single-tags a:hover,.main-top-content .single-tags a:hover,.post-details .link-wrap .single-tags a:hover,
        #contactform textarea:focus,#contactform input:not([type="submit"]):focus,.comments-form textarea:focus,.comments-form input:not([type="submit"]):focus,
        #contactform #submit,.comments-form #submit,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a,
        .flex-control-paging li {
        border-color: <?php echo esc_html(cs_get_option('front_color_3')); ?>;
        }

        .post-nav a span:hover {
        border-color: <?php echo esc_html(cs_get_option('front_color_3')); ?> !important
        }

        .col-md-4 .sidebar-item select,.col-md-3 .sidebar-item select,
        .pixxy_product_detail .sidebar-item,.shop-list-page .sidebar-item,
        .main-wrapper .col-md-4 .sidebar-item h5,
        .main-wrapper .col-md-3 .sidebar-item h5,
        .post-paper.center .sidebar-item {
        border-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.2) ?>;
        }

        .pricing .pricing-tab-item a {
        border-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.08) ?>;
        }

        .single-product .product .woocommerce-Reviews #review_form_wrapper input:focus,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper input:focus,.single-product .product .woocommerce-Reviews #review_form_wrapper textarea:focus,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper textarea:focus,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text:focus,.woocommerce form .form-row select:focus,.woocommerce form .form-row input:focus,
        .woocommerce form.login .form-row input:focus,.woocommerce form.login .form-row textarea:focus,.woocommerce form.checkout .form-row input:focus,.woocommerce form.checkout .form-row textarea:focus {
        outline-color: <?php echo esc_html(cs_get_option('front_color_3')); ?>;
        }

        .product-slider-wrapper .btn-wrap.dark>a,
        .a-btn-2,
        .a-btn-style-2 .wpcf7-form input[type="submit"],
        .error404 .main-wrapper.unit .a-btn-4,
        .woocommerce ul.products li.product .pixxy-prod-list-image .pixxy-add-to-cart a,
        .woocommerce div.product form.cart .button,
        .woocommerce-page.woocommerce-cart .woocommerce input.button,.woocommerce-page.woocommerce-checkout .woocommerce input.button,
        .woocommerce #respond input#submit,.woocommerce a.button,.woocommerce a.button.alt,.woocommerce button.button,.woocommerce input.button,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,
        .woocommerce form.login .form-row input[type="submit"]:focus,.woocommerce form.login .form-row input[type="submit"]:visited,.woocommerce form.login .form-row input[type="submit"]:active,.woocommerce form.login .form-row input[type="submit"],
        .woocommerce form.login .form-row input[type="submit"]:focus,.woocommerce form.login .form-row input[type="submit"]:visited,.woocommerce form.login .form-row input[type="submit"]:active,.woocommerce form.login .form-row input[type="submit"],
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
        .post-little-banner.empty-post-list input[type="submit"],
        #contactform #submit,.comments-form #submit{
        background-image: linear-gradient(to right, transparent 50%, <?php echo esc_html(cs_get_option('front_color_3')) ?> 50%);
        background-image: -webkit-gradient(linear, left top, right top, color-stop(50%, transparent), color-stop(50%, <?php echo esc_html(cs_get_option('front_color_3')) ?>));
        }

        .a-btn-3,
        .a-btn-style-3 .wpcf7-form input[type="submit"] {
        background-image: -webkit-gradient(linear, left top, right top, color-stop(50%, <?php echo esc_html(cs_get_option('front_color_3')) ?>), color-stop(50%, transparent));
        background-image: linear-gradient(to right, <?php echo esc_html(cs_get_option('front_color_3')) ?> 50%, transparent 50%);
        }

        .full-screen-slider__img:after {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.15) ?>;
        }

        .parallax-showcase-wrapper .parallax-showcase-item::before,
        .interactive-slider .tabs-item::before {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.2) ?>;
        }

        .overlay-dark {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.2) ?>;
        }

        .landing_split .images-wrap .image::before,
        .portfolio .item-overlay,
        .enable_overlay,
        .portfolio-content-pixxy.full_slider .slider-wrap::before,
        .post>.post-wrap-item:before,
        .overlay-dark-error,
        .post-media.iframe-video .video-container,
        .post.metro-style.format-video .video-container,.post.metro-style.format-post-video .video-container {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.3) ?>;
        }

        .showcase_slider .slide-image .hover_arrow {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.4) ?>;
        }

        .menio .banner-wrap::before {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.5) ?>;
        }

        .px-member__social {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.6) ?>;
        }

        .overlay-dark-2x {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.7) ?>;
        }

        .pixxy_copyright_overlay {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.95) ?>;
        }

        @media (max-width: 992px) {
        .px-categories .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
        .line-of-images.logos .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active{
        background-color: <?php echo esc_html(cs_get_option('front_color_3')); ?>;
        }

        .px-categories .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active::before,
        .line-of-images.logos .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active::before{
        border-color: <?php echo esc_html(cs_get_option('front_color_3')); ?>;
        }
        }

        @media only screen and (max-width: 767px) {
        .split_slider .split-wrapper .split-ms-left .split-ms-section {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('front_color_3')), 0.2) ?> !important;
        }
        }


    <?php endif;

        /* ======= LIGHT COLOR ======= */

        if (cs_get_option('light_color') && cs_get_option('light_color') !== '#ffffff') : ?>

        ::-moz-selection,
        ::selection,
        .text-light a,
        .text-light p,
        .mb_YTPPlaypause:before,
        .text-light,
        .highlight,
        .a-btn,
        .a-btn:focus,
        .a-btn-2:focus,
        .a-btn-2,
        .a-btn-3:hover,
        .a-btn-5,
        .a-btn-5:focus,
        .a-btn-7,
        .a-btn-7:focus,
        .a-btn-7:hover,
        .a-btn-style-1 .wpcf7-form input[type="submit"],
        .a-btn-style-1 .wpcf7-form input[type="submit"]:hover,
        .a-btn-style-2 .wpcf7-form input[type="submit"],
        .a-btn-style-2 .wpcf7-form input[type="submit"]:focus,
        .a-btn-style-3 .wpcf7-form input[type="submit"]:hover,
        .a-btn-style-4 .wpcf7-form input[type="submit"]:hover,
        .a-btn-style-5 .wpcf7-form input[type="submit"],
        .a-btn-style-5 .wpcf7-form input[type="submit"]:focus,
        .a-btn-style-7 .wpcf7-form input[type="submit"],
        .a-btn-style-7 .wpcf7-form input[type="submit"]:focus,
        .a-btn-style-7 .wpcf7-form input[type="submit"]:hover,
        mark,ins,
        button,html input[type=button],input[type=reset],input[type=submit],
        .error404 .light .bigtext,
        .error404 .light .title,
        .error404 .light .subtitle,
        .error404 .main-wrapper.unit .a-btn-4,
        .error404 .main-wrapper.unit .a-btn-4:focus,
        .col-md-4 .widget_tag_cloud a,.col-md-3 .widget_tag_cloud a,
        .portfolio .item-overlay>h5,
        .protected-page form input[type="submit"],
        .protected-page form input[type="submit"]:focus,
        .pixxy_copyright_overlay_text,
        .simple_gallery .flex-prev i,.simple_gallery .flex-next i,
        .alia .banner-wrap .title,
        .menio .banner-wrap .title,
        .menio .banner-wrap .social-list li a,
        .urban_slider .slick-arrow:hover,
        .full_screen_slider .swiper-arrow-left,
        .full_screen_slider .swiper-arrow-right,
        .full_screen_slider .slider-click,
        .full_screen_slider .slider-click.left .arrow::before,
        .full_screen_slider .slider-click.right .arrow::before,
        .full-screen-slider__img .full-content-wrap,
        .portfolio-content-pixxy.full_slider .content-wrap .portfolio-title,
        .woocommerce ul.products li.product .pixxy-prod-list-image .pixxy-add-to-cart a,
        .woocommerce div.product form.cart .button,
        .woocommerce div.product form.cart .button:focus,
        .woocommerce-page.woocommerce-cart .woocommerce input.button,.woocommerce-page.woocommerce-checkout .woocommerce input.button,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce a.button.alt,.woocommerce button.button,.woocommerce input.button,
        .woocommerce-page.woocommerce-cart .woocommerce input.button:focus,.woocommerce-page.woocommerce-checkout .woocommerce input.button:focus,.woocommerce #respond input#submit:focus,.woocommerce a.button:focus,.woocommerce a.button.alt:focus,.woocommerce button.button:focus,.woocommerce input.button:focus,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit,
        .single-product .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit:focus,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper .comment-form .form-submit input#submit:focus,
        .input_shop_wrapper:hover,
        .woocommerce ul.products li.product .pixxy_product_list_name .count,
        .pixxy_cart.shop_table .complement-cart .coupon .input-text.button,.woocommerce form .form-row select.button,.woocommerce form .form-row input.button,
        .woocommerce form.login .form-row input[type="submit"]:focus,.woocommerce form.login .form-row input[type="submit"]:visited,.woocommerce form.login .form-row input[type="submit"]:active,.woocommerce form.login .form-row input[type="submit"],
        .woocommerce .woocommerce-error li strong,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
        .woocommerce .woocommerce-message,.woocommerce .woocommerce-info,.woocommerce .woocommerce-error,
        .woocommerce .woocommerce-message a:not(.button),.woocommerce .woocommerce-info a:not(.button),.woocommerce .woocommerce-error a:not(.button),
        .woocommerce .woocommerce-message:before,.woocommerce .woocommerce-info:before,.woocommerce .woocommerce-error:before,
        .woocommerce .woocommerce-message a.button,.woocommerce .woocommerce-info a.button,.woocommerce .woocommerce-error a.button,
        .woocommerce-page .unit .woocommerce a.button,
        .woocommerce ul.products li.product .pixxy-prod-list-image .pixxy-add-to-cart a:focus,
        .post-little-banner.empty-post-list input[type="submit"],
        .post-media .video-content .play:hover,
        .post-media .close,
        .post.center-style.format-gallery .flex-prev i,.post.center-style.format-gallery .flex-next i,
        .post.center-style.format-post-slider .flex-prev i,.post.center-style.format-post-slider .flex-next i,
        .post.center-style.format-link .category a:hover,.post.center-style.format-post-link .category a:hover,
        .post.center-style.format-link .date a:hover,.post.center-style.format-post-link .date a:hover,
        .post.center-style.format-link .link-wrap,.post.center-style.format-post-link .link-wrap,
        .post.center-style.format-link .link-wrap a,.post.center-style.format-post-link .link-wrap a,
        .post.metro-style .info-wrap .category a,
        .post.metro-style.format-video .video-content .play:hover,.post.metro-style.format-post-video .video-content .play:hover,
        .post.metro-style.format-link .link-wrap a,.post.metro-style.format-post-link .link-wrap a,
        .post.metro-style.format-gallery .flex-prev:hover,.post.metro-style.format-gallery .flex-next:hover,.post.metro-style.format-post-slider .flex-prev:hover,.post.metro-style.format-post-slider .flex-next:hover,
        .post-paper.masonry .post.metro-style.format-gallery .flex-prev:not(:hover),.post-paper.masonry .post.metro-style.format-gallery .flex-next:not(:hover),.post-paper.masonry .post.metro-style.format-post-slider .flex-prev:not(:hover),.post-paper.masonry .post.metro-style.format-post-slider .flex-next:not(:hover),.post-paper.masonry .post.metro-style.format-video .video-content .play:not(:hover),.post-paper.masonry .post.metro-style.format-post-video .video-content .play:not(:hover),
        .post-content h5,
        .post-content .date,
        .post-wrap-item.text .post-content i,
        .post-wrap-item.text .post-content blockquote,
        .single-post .single-content .img-slider .flex-prev i,.single-post .single-content .img-slider .flex-next i,
        .main-wrapper .col-md-4 .sidebar-item.widget_tag_cloud a,.main-wrapper .col-md-3 .sidebar-item.widget_tag_cloud a,
        .post-details .single-categories a,
        .post-info .single-tags a:hover,.bottom-infopwrap .single-tags a:hover,.user-info-wrap .single-tags a:hover,.main-top-content .single-tags a:hover,.post-details .link-wrap .single-tags a:hover,
        #contactform #submit,.comments-form #submit,
        #contactform #submit:focus,.comments-form #submit:focus,
        .unit .post-details .single-categories a,
        .unit .post-details .single-categories a:hover,
        .unit .post-details .single-tags:hover,
        .unit.main-wrapper .col-md-3 .sidebar-item.widget_tag_cloud a:hover,
        .unit .post-info .single-tags a:hover,.unit .bottom-infopwrap .single-tags a:hover,.unit .user-info-wrap .single-tags a:hover,.unit .main-top-content .single-tags a:hover,.unit .post-details .link-wrap .single-tags a:hover,
        .post-info span a,
        .top-banner.light .title,
        .top-banner.light .descr,
        .top-banner.light .subtitle,
        .banner-slider-wrap .swiper-pagination span,
        .banner-slider-wrap.vertical-2 .title,
        .banner-slider-wrap.vertical-2 .light .subtitle,
        .banner-slider-wrap.vertical-2 .light .title,
        .banner-slider-wrap.vertical-2.content-light .swiper-pagination .swiper-pagination-bullet-active i,
        .banner-slider-wrap.myro .content-wrap .subtitle,
        .banner-slider-wrap.myro .content-wrap .title,
        .banner-slider-wrap.myro .content-wrap .swiper-pagination span,
        .banner-slider-wrap.myro .content-wrap .swiper-pagination .swiper-pagination-total,
        .banner-slider-wrap.urban .title,
        .banner-slider-wrap.urban .subtitle,
        .banner-slider-wrap.urban .pag-wrapper .swiper-pagination,
        .banner-slider-wrap.urban .pag-wrapper .swiper-pagination-current,
        .banner-slider-wrap.urban .pag-wrapper .swiper-pagination-total,
        .banner-slider-wrap.urban .pag-wrapper .swiper-button-next,
        .banner-slider-wrap.urban .pag-wrapper .swiper-button-prev,
        .cta.light .cta-title,.cta.light .cta-description,
        .px-categories__title,
        .iframe-video.banner-video .title,
        .iframe-video.banner-video .video-content span,
        .iframe-video .video-close-button,
        .iframe-video.banner-video.simple .play-button:hover,
        .glitch-wrapper.style-1 .title,
        .glitch-wrapper.style-1 .text,
        .glitch-wrapper.style-2 .title,
        .headings.bg-animation .title,
        .headings.light .title,
        .headings.light .description,.headings.light .subtitle,
        .last-posts .post-item__image .post-categories a,
        .px-parallax__video-wrapper .play-button,
        .physics-banner .title,
        .physics-banner .text,
        .parallax-showcase-wrapper .title,
        .parallax-showcase-wrapper .desc,
        .urban_slider .slick-arrow:hover,
        .urban_slider .pagination-category,
        .urban_slider .slick-current .pagination-category,
        .interactive-slider.tabs li.active div,
        .interactive-slider.tabs a,
        .interactive-slider.tabs a:hover div,
        .landing_split .content-wrap .portfolio-title,
        .landing_split .content-wrap .excerpt,
        .pricing-simple-item.active .pricing-simple-cost,.pricing-simple-item.active .pricing-simple-title,.pricing-simple-item.active .pricing-simple-lab,
        .pricing-simple-item.active .pricing-simple-params p,
        .pricing-simple-item.active .pricing-simple-params p:before,
        .pricing-simple-item.active .pricing-simple-params p.passive:before,
        .product-slider-wrapper [data-content-color="light"] .woocommerce-loop-product__title,
        .product-slider-wrapper [data-content-color="light"] .prod-descr,
        .product-slider-wrapper .btn-wrap.light>a:hover,
        .product-slider-wrapper--light .socials,.product-slider-wrapper--light a.additional-link,.product-slider-wrapper--light a.additional-email,
        .product-slider-wrapper--light .swiper-pagination .swiper-pagination-bullet-active i,
        .product-slider-wrapper .content-transition .socials,.product-slider-wrapper .content-transition .swiper-pagination,.product-slider-wrapper .content-transition a.additional-link,.product-slider-wrapper .content-transition a.additional-email,
        .product-tabs-wrapper .image-wrap .onsale,
        .product-tabs-wrapper .image-wrap .on-new,
        .px-member__social-item,
        .iframe-video.banner-video .title,
        .iframe-video.banner-video .video-content span,
        .iframe-video.banner-video.simple .play-button:hover,
        .px-media .iframe-video.banner-video.simple .play-button:before,
        .skills.light .skill,
        .skill-wrapper.light .subtitle,.skill-wrapper.light .title,.skill-wrapper.light .text,
        .split-wrapper .content-wrap.light .title,
        .split-wrapper .content-wrap.light .wpcf7 textarea:focus,.split-wrapper .content-wrap.light .wpcf7 input:not([type="submit"]):focus,
        .about-section .bg-title,
        .headings .bg-title,
        .product-slider-wrapper .bg-title,
        .showcase_slider .slide-image .arrow::before {
        color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }

        .woocommerce-page.woocommerce .sidebar-item a.button,
        .woocommerce-page.woocommerce .sidebar-item.widget_shopping_cart a.button {
        color: <?php echo esc_html(cs_get_option('light_color')) ?> !important;
        }

        .physics-banner .arrows path {
        stroke: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }

        .white,
        .animsition-loading,
        .spinner-preloader-wrap .cssload-container .cssload-item,
        .preloader-modern,
        .a-btn-4,
        .a-btn-5:hover,
        .a-btn-style-4 .wpcf7-form input[type="submit"],
        .a-btn-style-5 .wpcf7-form input[type="submit"]:hover,
        .sidebar-item input,
        .protected-page form input:not([type="submit"]),
        .simple_gallery .flex-prev:hover,.simple_gallery .flex-next:hover,
        .parallax-window .content-parallax,
        .urban_slider .slick-arrow,
        .full_screen_slider .swiper-arrow-left::before,.full_screen_slider .swiper-arrow-right::before,
        .select2-container,
        .woocommerce ul.products li.product .pixxy-prod-list-image,
        .woocommerce ul.products li.product .on-new,.woocommerce ul.products li.product .onsale,
        .woocommerce ul.products li.product .pixxy-prod-list-image:after,
        .pixxy_product_detail .product .pixxy_images figure+.on-new,.pixxy_product_detail .product .pixxy_images figure+.onsale,.single-product .product .pixxy_images figure+.on-new,.single-product .product .pixxy_images figure+.onsale,
        .pixxy_product_detail .product .pixxy_images a .on-new,.pixxy_product_detail .product .pixxy_images a .onsale,.single-product .product .pixxy_images a .on-new,.single-product .product .pixxy_images a .onsale,
        .product-gallery-wrap .on-new,
        .product-gallery-thumbnail-wrap .img-wrapper,
        .single-product .product .woocommerce-Reviews #review_form_wrapper input,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper input,.single-product .product .woocommerce-Reviews #review_form_wrapper textarea,.pixxy_product_detail .product .woocommerce-Reviews #review_form_wrapper textarea,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .post-little-banner.empty-post-list input:not([type="submit"]),
        .post-media .video-content .play,
        .post.center-style .info-wrap,
        .post.metro-style .post-wrap-item,
        .post.metro-style .info-wrap,
        .post.metro-style.format-video .video-content .play,.post.metro-style.format-post-video .video-content .play,
        .post.metro-style.format-gallery .flex-prev,.post.metro-style.format-gallery .flex-next,.post.metro-style.format-post-slider .flex-prev,.post.metro-style.format-post-slider .flex-next,
        .unit .blog.masonry+.sidebar .sidebar-item,
        .single-post .single-content,
        .single-post .single-content .swiper-container .description,
        .single-post .single-content .img-slider .flex-prev:hover,.single-post .single-content .img-slider .flex-next:hover,
        .main-wrapper .col-md-4 .sidebar-item,.main-wrapper .col-md-3 .sidebar-item,
        .post-banner,
        #contactform textarea,#contactform input:not([type="submit"]),.comments-form textarea,.comments-form input:not([type="submit"]),
        .unit .post-little-banner+.post-paper.padding-both,
        .page-template-default .unit .single-post,
        .single-post .single-content .swiper-arrow-right,.single-post .single-content .swiper-arrow-left,
        .flex-control-paging li a,
        body,
        .spinner-preloader-wrap,
        .unit .sub-menu,
        .last-posts .post-item__wrapper,
        .px-slider.horizontal .px-slider__item,
        .px-slider.horizontal_2 .px-slider__item,
        .services--shadow,
        .px-services-list__wrapper:before,.px-services-list__wrapper:after,
        .px-services-list__item,
        .px-testimonial.multiple .swiper-pagination-bullet,
        .px-testimonial.multiple .content-slide,.px-testimonial.multiple_style_2 .content-slide,
        .px-testimonial.flipping .flip-current,
        .px-testimonial.flipping .flipto:hover,
        .px-slider.horizontal_2 .swiper-pagination-bullet {
        background: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }

        .discount__content .subtitle,
        .top-banner.light .title:before,
        .banner-slider-wrap .swiper-pagination span:first-child::before,
        .banner-slider-wrap.vertical-1 .swiper-pagination .swiper-pagination-bullet-active i::before,
        .coming-page-wrapper .form input:not([type="submit"]),.coming-page-wrapper .form textarea,
        .iframe-video.banner-video.simple .play-button,
        .headings.light .title--delimiter:after,
        .urban_slider .slick-arrow,
        .split-wrapper .vertical::before,.split-wrapper .vertical::after,
        .split-wrapper .horizontal::after,.split-wrapper .horizontal::before,
        .pricing .pricing-item,
        .pricing .pricing-tab-item.active a,
        .pricing-simple-item,
        .product-slider-wrapper--light a.additional-link:before,
        .product-slider-wrapper .content-transition a.additional-link:before,
        #multiscroll-nav a.active,
        .px-testimonial .social>a:before,
        .iframe-video.banner-video.simple .play-button,
        abbr,acronym,code,
        .iframe-video.audio,
        .metro-load-more,
        .grey,
        .unit .shop-list-page,.unit .pixxy_product_detail,
        .unit .shop-list-page:after,.unit .pixxy_product_detail:after,
        .post-paper,
        .single-post .main-wrapper,
        .unit .single-post,
        .post-little-banner,
        .post.center-style.format-quote .info-wrap,.post.center-style.format-post-text .info-wrap,
        .scroll,
        .error404 .main-wrapper.unit,
        .pixxy-shop-banner,
        .simple_slider .single-pagination::before,
        .alia.single-pagination::before,
        .urban.single-pagination::before,
        .urban .banner-wrap,
        .tile_info .recent-posts-wrapper,
        .menio .recent-posts-wrapper,
        body.search,
        .unit .single-post pre,
        .unit .single-content pre,
        .unit .post-paper pre,
        .single-product .product .summary .cart .variations .value ul li label:before,.pixxy_product_detail .product .summary .cart .variations .value ul li label:before,
        .woocommerce form.login .form-row label.checkbox:before,.woocommerce form.checkout .form-row label.checkbox:before,.woocommerce .woocommerce-shipping-fields label.checkbox:before,
        .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
        .pixxy-shop-banner .pixxy-shop-menu ul li:not(:last-of-type)::after,
        .post-little-banner.empty-post-list input:not([type="submit"]):focus,
        .post-info span.author {
        background-color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }

        .a-btn-4,
        .a-btn-4:hover,
        .a-btn-5,
        .a-btn-style-4 .wpcf7-form input[type="submit"],
        .a-btn-style-4 .wpcf7-form input[type="submit"]:hover,
        .a-btn-style-5 .wpcf7-form input[type="submit"],
        .a-btn-style-5 .wpcf7-form input[type="submit"]:hover,
        .woocommerce .woocommerce-message a.button,.woocommerce .woocommerce-info a.button,.woocommerce .woocommerce-error a.button,
        .woocommerce .woocommerce-message a.button:hover,.woocommerce .woocommerce-info a.button:hover,.woocommerce .woocommerce-error a.button:hover,
        .flex-control-paging li a,
        .product-slider-wrapper .btn-wrap.light>a,
        .pricing-simple-item.active.border:after,
        .px-accordion__item-title,
        .coming-page-wrapper .form input:not([type="submit"]),.coming-page-wrapper .form textarea,
        .pricing-simple-title,
        .split-wrapper .wpcf7 textarea,.split-wrapper .wpcf7 input:not([type="submit"]),
        .px-services-list__item,
        .headings .title--delimiter:after,
        .pricing .title--delimiter:after,
        .px-testimonial.full_width .swiper-pagination .swiper-pagination-bullet,
        .px-testimonial.multiple_style_2 .swiper-pagination-bullet,
        .px-testimonial .social>a,
        .product-tabs-wrapper .swiper-pagination .swiper-pagination-bullet,
        .product-slider-wrapper--light .swiper-pagination .swiper-pagination-bullet::after,.product-slider-wrapper--light .swiper-pagination .swiper-pagination-bullet::before,
        .px-testimonial.full_width [class^="swiper-button"] {
        border-color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }

        .px-slider.horizontal .px-slider__item:after,
        .px-slider.horizontal_2 .px-slider__item:before {
        border-bottom-color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }

        .a-btn-4,
        .a-btn-style-4 .wpcf7-form input[type="submit"],
        .a-btn-5:hover,
        .a-btn-style-5 .wpcf7-form input[type="submit"],
        .product-slider-wrapper .btn-wrap.light>a,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a,
        .woocommerce .woocommerce-message a.button,.woocommerce .woocommerce-info a.button,.woocommerce .woocommerce-error a.button{
        background-image: -webkit-gradient(linear, left top, right top, color-stop(50%, transparent), color-stop(50%, <?php echo esc_html(cs_get_option('light_color')) ?>));
        background-image: linear-gradient(to right, transparent 50%, <?php echo esc_html(cs_get_option('light_color')) ?> 50%);
        }

        @media only screen and (min-width: 1200px) {
        .portfolio-content-pixxy.left_gallery .single-pagination.left_gallery.change-color a.content {
        color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }
        }

        @media (max-width: 991px) {
        .line-of-images.logos .swiper-pagination .swiper-pagination-bullet {
        background-color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }
        }

        @media only screen and (max-width: 767px) {
        .single-post .main-wrapper,
        .banner-gallery::before {
        background-color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }

        .split-ms-right .split-ms-section::before {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.15) ?>;
        }
        }

        .split-wrapper .content-wrap.light .wpcf7 textarea,.split-wrapper .content-wrap.light .wpcf7 input:not([type="submit"]) {
        color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.3) ?>;
        }

        .product-slider-wrapper--light .swiper-pagination {
        color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.5) ?>;
        }

        .product-tabs-wrapper .image-wrap {
        color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.8) ?>;
        }

        .woocommerce .woocommerce-error li {
        color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.7) ?> !important;
        }

        .split-wrapper .content-wrap.light .wpcf7 textarea,.split-wrapper .content-wrap.light .wpcf7 input:not([type="submit"]) {
        border-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.2) ?>;
        }

        .pricing-simple-item.active .pricing-simple-title {
        border-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.26) ?>;
        }

        .a-btn-5:hover {
        border-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.3) ?>;
        }

        .pricing-simple-item.active .pricing-simple-lab {
        border-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.36) ?>;
        }

        .skills.light .line {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.18) ?>;
        }

        .banner-slider-wrap.vertical-2.content-light .swiper-pagination .swiper-pagination-bullet::after,
        .banner-slider-wrap.vertical-2.content-light .swiper-pagination .swiper-pagination-bullet::before{
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.3) ?>;
        }

        .banner-slider-wrap.andra .swiper-pagination span:first-child::before,
        .banner-slider-wrap.myro .content-wrap .swiper-pagination span:first-child::before{
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.7) ?>;
        }

        .coming-page-wrapper .form input:not([type="submit"]):focus,.coming-page-wrapper .form textarea:focus {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.9) ?>;
        }

        .gallery-single .gallery-item.hover9 .item-img::before,.portfolio .item-link.hover9 .item-img::before,
        .portfolio .item-link.hover9.yes .item-img::before {
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.3) ?> 100%);
        }

        @media (min-width: 993px) {
        .px-testimonial.multiple_style_2:after {
        border-color: <?php echo esc_html(cs_get_option('light_color')) ?>;
        }
        }

        @media (max-width: 992px) {
        .px-categories .swiper-pagination .swiper-pagination-bullet {
        background-color: <?php echo hex2rgba(esc_html(cs_get_option('light_color')), 0.3) ?>;
        }
        }

    <?php endif;


        /* ======= FIRST BASE COLOR ======= */

        if (cs_get_option('base_color_1') && cs_get_option('front_color_1')) : ?>

        .a-btn-7,
        .a-btn-style-7 .wpcf7-form input[type="submit"] {
        background-color: <?php echo esc_html(cs_get_option('base_color_1')); ?>;
        }

        .a-btn-7:hover,
        .a-btn-style-7 .wpcf7-form input[type="submit"]:hover {
        background-color: <?php echo esc_html(cs_get_option('front_color_1')); ?>;
        }

        .a-btn-7,
        .a-btn-style-7 .wpcf7-form input[type="submit"] {
        background-image: -webkit-linear-gradient(345deg, <?php echo esc_html(cs_get_option('base_color_1')); ?>, <?php echo esc_html(cs_get_option('front_color_1')); ?>, <?php echo esc_html(cs_get_option('base_color_1')); ?>);
        background-image: -o-linear-gradient(345deg, <?php echo esc_html(cs_get_option('base_color_1')); ?>, <?php echo esc_html(cs_get_option('front_color_1')); ?>, <?php echo esc_html(cs_get_option('base_color_1')); ?>);
        background-image: linear-gradient(105deg, <?php echo esc_html(cs_get_option('base_color_1')); ?>, <?php echo esc_html(cs_get_option('front_color_1')); ?>, <?php echo esc_html(cs_get_option('base_color_1')); ?>);
        }

        .pricing-simple-label {
        background-image: linear-gradient(126deg, <?php echo esc_html(cs_get_option('base_color_1')); ?>, <?php echo esc_html(cs_get_option('front_color_1')); ?>);
        }

        .pricing-simple-item.active {
        background-image: linear-gradient(136deg, <?php echo esc_html(cs_get_option('base_color_1')); ?>, <?php echo esc_html(cs_get_option('front_color_1')); ?>);
        }

        .last-posts .post-item__image .post-categories a {
        background-image: linear-gradient(97deg, <?php echo esc_html(cs_get_option('base_color_1')); ?>, <?php echo esc_html(cs_get_option('front_color_1')); ?>);
        }

    <?php endif;



        /* ======= FOOTER SIMPLE ======= */
        /* ======= FOOTER BACKGROUND COLOR ======= */


        if (cs_get_option('footer_simple_bg_color') && cs_get_option('footer_simple_bg_color') !== '#fff') : ?>
        #footer.simple,
        #footer.simple .footer-bottom-wrap{
        background-color: <?php echo esc_html(cs_get_option('footer_simple_bg_color')) ?>;
        }


    <?php endif;


        /* ======= FOOTER TEXT COLOR ======= */


        if (cs_get_option('footer_simple_main_text_color')) : ?>
        #footer .socials a:hover,
        .footer-instagram .instagram-text a{
        color: <?php echo esc_html(cs_get_option('footer_simple_main_text_color')) ?>;
        }
    <?php endif;

        if (cs_get_option('footer_simple_dark_text_color') && cs_get_option('footer_simple_dark_text_color') !== '#222') :

            ?>
        #footer.simple .sidebar-item[class*='widget_'] select,
        #footer.simple .pixxy-widget-about .about_content,
        #footer.simple .sidebar-item.widget_nav_menu h5,
        #footer.simple .menu li a,
        #footer.simple .sidebar-item .item-wrap h3,
        #footer.simple .footer-menu-wrap ul li a,
        #footer.simple .sidebar-item .item-wrap h5,
        #footer.simple .menu li a,
        #footer.simple .pixxy-widget-subscribe input:not([type="submit"]),
        #footer.simple .copyright a,
        #footer.simple .sidebar-item #wp-calendar caption,
        #footer.simple .widget_calendar th,
        #footer.simple .widget_calendar tr,
        #footer.simple .sidebar-item.widget_calendar table a,
        #footer.simple .sidebar-item li,
        #footer.simple .sidebar-item .item-wrap h5,
        #footer.simple .pixxy-widget-subscribe input:not([type="submit"]),
        #footer.simple .widget_text .textwidget a:hover,
        #footer.simple .socials a:not(:hover),
        #footer.simple .footer-instagram .instagram-text a:hover,
        #footer.simple .footer-info .footer-info-text a:hover,
        #footer.simple .footer-info p a:hover,
        #footer.simple .footer-info .footer-logo{
        color: <?php echo esc_html(cs_get_option('footer_simple_dark_text_color')) ?>;
        }
        #footer.simple .pixxy-widget-subscribe input[type="submit"] {
        background-color: <?php echo esc_html(cs_get_option('footer_simple_dark_text_color')) ?>;
        }
    <?php endif;

        if (cs_get_option('footer_simple_grey_text_color') && cs_get_option('footer_simple_grey_text_color') !== '#888') : ?>

        #footer.simple .footer-info .footer-info-text,
        #footer.simple .footer-info p,
        #footer.simple .sidebar-item #wp-calendar caption,#footer.simple .widget_calendar th,#footer.simple .widget_calendar tr,#footer.simple .sidebar-item.widget_calendar table a,
        #footer.simple .sidebar-item li,
        #footer.simple .widget_text .textwidget p,#footer.simple .widget_text .textwidget a,
        #footer.simple .pixxy-widget-social-link a,
        #footer.simple .pixxy-widget-about .about_content.text,
        #footer.simple .sidebar-item .pixxy-widget-subscribe .pixxy-widget-descr,
        #footer.simple .copyright,
        #footer.simple .widget_calendar td,
        #footer.simple .footer-instagram .instagram-text,
        #footer.simple .sidebar-item[class*='widget_'] a,
        #footer.simple .sidebar-item[class*='widget_'] label,
        #footer.simple .sidebar-item[class*='widget_'] p,
        #footer.simple .sidebar-item[class*='widget_'] strong,
        #footer.simple .sidebar-item[class*='widget_'] span,
        #footer.simple .sidebar-item[class*='widget_'] caption,
        #footer.simple .sidebar-item[class*='widget_'] a.rsswidget,
        #footer.simple .sidebar-item[class*='widget_'].widget_rss cite,
        #footer.simple .sidebar-item[class*='widget_'] a:hover,
        #footer.simple .sidebar-item[class*='widget_'] a:hover>span,
        #footer.simple .search-form input {
        color: <?php echo esc_html(cs_get_option('footer_simple_grey_text_color')) ?>;
        }

        #footer.simple .search-form input {
        border-color: <?php echo esc_html(cs_get_option('footer_simple_grey_text_color')) ?>;
        }

    <?php endif;


        /* ======= FOOTER MODERN ======= */
        /* ======= FOOTER BACKGROUND COLOR ======= */
        if (cs_get_option('footer_modern_bg_color') && cs_get_option('footer_modern_bg_color') !== '#222222') : ?>
        #footer.modern,
        #footer.modern .footer-bottom-wrap {
        background-color: <?php echo esc_html(cs_get_option('footer_modern_bg_color')) ?>;
        }
    <?php endif;

        /* ======= FOOTER TEXT COLOR ======= */

        if (cs_get_option('footer_modern_light_text_color') && cs_get_option('footer_modern_light_text_color') !== '#ffffff') : ?>
        #footer.modern .sidebar-item #wp-calendar caption,
        #footer.modern .widget_calendar th,
        #footer.modern .widget_calendar tr,
        #footer.modern .sidebar-item.widget_calendar table a,
        #footer.modern .sidebar-item[class*='widget_'] label,
        #footer.modern .sidebar-item[class*='widget_'] p,
        #footer.modern .sidebar-item[class*='widget_'] strong,
        #footer.modern .sidebar-item[class*='widget_'] span,
        #footer.modern .sidebar-item[class*='widget_'] caption,
        #footer.modern .copy_content,
        #footer.modern .pixxy-widget-about .about_content,
        #footer.modern .pixxy-widget-social-link a,
        #footer.modern .pixxy-widget-copyright .socials a,
        #footer.modern .pixxy-widget-subscribe p::after,
        #footer.modern .pixxy-widget-subscribe input,
        #footer.modern .PixxyInstagramWidget .instagram-text a,
        #footer.modern .footer-bottom-wrap .copyright a,#footer.modern .footer-bottom-wrap .copyright,
        #footer.modern .footer-menu-wrap ul li a,
        #footer.modern .footer-socials a,
        #footer.modern .social-links a,
        #footer.modern .widget_text h5,
        #footer.modern .sidebar-item.widget_nav_menu h5,
        #footer.modern .sidebar-item[class*='widget_'] h5,
        #footer.modern .sidebar-item h5,
        #footer.modern .sidebar-item .item-wrap h3:not(.pixxy-widget-descr),
        #footer.modern .sidebar-item[class*='widget_'] a.rsswidget,
        #footer.modern .sidebar-item[class*='widget_'].widget_rss cite,
        #footer.modern .widget_product_search form::after,
        #footer.modern .widget_search form div::after,
        #footer.modern .pixxy-recent-post-widget .recent-text a,
        #footer.modern .footer-info .footer-logo,
        #footer.modern .socials a,
        #footer.modern .sidebar-item[class*='widget_'] li a:hover,
        #footer.modern .footer-info .footer-info-text a:hover,
        #footer.modern .footer-info p a:hover {
        color: <?php echo esc_html(cs_get_option('footer_modern_light_text_color')) ?>;
        }

        #footer.modern .sidebar-item[class*='widget_'] select,
        #footer.modern .pixxy-widget-subscribe input:not([type="submit"]) {
        background-color: <?php echo esc_html(cs_get_option('footer_modern_light_text_color')) ?>;
        }
    <?php endif;


        if (cs_get_option('footer_modern_grey_text_color') && cs_get_option('footer_modern_grey_text_color') !== '#888') : ?>
        #footer.modern .pixxy-widget-copyright .copy_content,
        #footer.modern .sidebar-item .pixxy-widget-subscribe .pixxy-widget-descr,
        #footer.modern .sidebar-item li,
        #footer.modern .widget_calendar td,
        #footer.modern .sidebar-item[class*='widget_'] a,
        #footer.modern .pixxy-recent-post-widget .recent-date,
        #footer.modern .pixxy-recent-post-widget a,
        #footer.modern .footer-info .footer-info-text,
        #footer.modern .footer-info p,
        #footer.modern .pixxy-widget-subscribe input:not([type="submit"]),
        #footer.modern .socials a:hover {
        color: <?php echo esc_html(cs_get_option('footer_modern_grey_text_color')) ?>;
        }
        #footer.modern .pixxy-widget-subscribe p::after {
        background-color: <?php echo esc_html(cs_get_option('footer_modern_grey_text_color')) ?>;
        }
    <?php endif;


        /* ======= FOOTER CLASSIC ======= */
        /* ======= FOOTER BACKGROUND COLOR ======= */
        if (cs_get_option('footer_classic_bg_color') && cs_get_option('footer_classic_bg_color') !== '#ffffff') : ?>
        #footer.classic {
        background-color:<?php echo esc_html(cs_get_option('footer_classic_bg_color')) ?>;
        }
    <?php endif;

        /* ======= FOOTER TEXT COLOR ======= */

        if (cs_get_option('footer_classic_dark_text_color') && cs_get_option('footer_classic_dark_text_color') !== '#222222') : ?>
        #footer.classic .footer-logo,
        #footer.classic .copyright a,
        #footer.classic .socials a:hover,
        .footer-menu li a:hover,
        .footer-menu li.current-menu-item a{
        color:<?php echo esc_html(cs_get_option('footer_classic_dark_text_color')) ?>;
        }
    <?php endif;


        if (cs_get_option('footer_classic_grey_text_color') && cs_get_option('footer_classic_grey_text_color') !== '#888') : ?>
        #footer.classic .copyright,
        #footer.classic .socials a,
        .footer-menu li a {
        color: <?php echo esc_html(cs_get_option('footer_classic_grey_text_color')) ?>;
        }
    <?php endif;
    }


    //TYPOGRAPHY
    $options = apply_filters('cs_get_option', get_option(CS_OPTION));

    function get_str_by_number($str)
    {
        $number = preg_replace("/[0-9|\.]/", '', $str);
        return $number;
    }

    foreach ($options as $key => $item) {
        if (is_array($item)) {
            if (!empty($item['variant']) && $item['variant'] == 'regular') {
                $item['variant'] = 'normal';
            }
        }
        $options[$key] = $item;
    }

    function calculateFontWeight($fontWeight)
    {
        $fontWeightValue = '';
        $fontStyleValue = '';

        switch ($fontWeight) {
            case '100':
                $fontWeightValue = '100';
                break;
            case '100italic':
                $fontWeightValue = '100';
                $fontStyleValue = 'italic';
                break;
            case '300':
                $fontWeightValue = '300';
                break;
            case '300italic':
                $fontWeightValue = '300';
                $fontStyleValue = 'italic';
                break;
            case '500':
                $fontWeightValue = '500';
                break;
            case '500italic':
                $fontWeightValue = '500';
                $fontStyleValue = 'italic';
                break;
            case '600italic':
                $fontWeightValue = '600';
                $fontStyleValue = 'italic';
                break;
            case '600':
                $fontWeightValue = '600';
                break;
            case '700':
                $fontWeightValue = '700';
                break;
            case '700italic':
                $fontWeightValue = '700';
                $fontStyleValue = 'italic';
                break;
            case '900':
                $fontWeightValue = '900';
                break;
            case '900italic':
                $fontWeightValue = '900';
                $fontStyleValue = 'italic';
                break;
            case 'italic':
                $fontStyleValue = 'italic';
                break;
        }

        return array('weight' => $fontWeightValue, 'style' => $fontStyleValue);
    }

    $all_button_font = $options['all_button_font_family']; ?>

    .a-btn, .a-btn-2, .a-btn-3, .a-btn-4, .a-btn-5, .a-btn-6, .a-btn-7,
    .btn-style-1 input[type="submit"],
    .btn-style-2 input[type="submit"],
    .btn-style-3 input[type="submit"],
    .btn-style-4 input[type="submit"],
    .btn-style-5 input[type="submit"],
    .btn-style-6 input[type="submit"],
    .btn-style-7 input[type="submit"]{
    <?php
    if (!empty($all_button_font['family'])) {
        echo "font-family: \"{$all_button_font['family']}\" !important;";
    }

    $variant = calculateFontWeight($all_button_font['variant']);
    if (!empty($variant['style'])) : ?> font-style: <?php echo esc_html($variant['style']); ?> !important;
    <?php endif;
    if (!empty($variant['weight'])) : ?> font-weight: <?php echo esc_html($variant['weight']); ?> !important;
    <?php endif;

    $button_font_style = get_str_by_number($all_button_font['variant']);
    if (!empty($button_font_style) && !empty($all_button_font['family'])) {
        echo "font-style:{$button_font_style} !important;";
    }

    $all_button_font_size = get_number_str($options['all_button_font_size']);
    if (!empty($all_button_font_size)) {
        echo "font-size: {$all_button_font_size}px !important;";
    }

    $all_button_line_height = get_number_str($options['all_button_line_height']);
    if (!empty($all_button_line_height)) {
        echo "line-height:{$all_button_line_height}px !important;";
    }
    if (!empty($options['all_button_letter_spacing'])) {
        echo "letter-spacing:{$options['all_button_letter_spacing']} !important;";
    } ?>
    }

    <?php $all_links_font = $options['all_links_font_family']; ?>
    a {
    <?php if (!empty($all_links_font['family'])) {
        echo "font-family: \"{$all_links_font['family']}\" !important;";
    }
    $variant = calculateFontWeight($all_links_font['variant']);
    if (!empty($all_links_font['family']) && !empty($variant['style'])) : ?> font-style: <?php echo esc_html($variant['style']); ?> !important;
    <?php endif;
    if (!empty($variant['weight'])) : ?> font-weight: <?php echo esc_html($variant['weight']); ?> !important;
    <?php endif;

    $all_links_font_size = get_number_str($options['all_links_font_size']);
    if (!empty($all_links_font_size)) {
        echo "font-size: {$all_links_font_size}px !important;";
    }

    $all_links_line_height = get_number_str($options['all_links_line_height']);
    if (!empty($all_links_line_height)) {
        echo "line-height:{$all_links_line_height}px !important;";
    }

    $all_links_letter_spacing = get_number_str($options['all_links_letter_spacing']);
    if (!empty($all_links_letter_spacing)) {
        echo "letter-spacing:{$all_links_letter_spacing} !important;";
    } ?>
    }

    /*FOOTER*/
    <?php function get_number_str($str)
    {
        $number = preg_replace("/[^0-9|\.]/", '', $str);
        return $number;
    }


    /* FOR TITLE H1 - H6 */
    if (cs_get_option('heading')) {
        foreach (cs_get_option('heading') as $title) {
            $font_family = $title['heading_family'];
            echo esc_attr($title['heading_tag']); ?> ,
            <?php echo esc_attr($title['heading_tag']); ?> a {
            <?php if ($font_family['family']) {
                        echo "font-family: {$font_family['family']} !important;";
                    }
                    $one_title_size = get_number_str($title['heading_size']);
                    if ($one_title_size) {
                        echo "font-size: {$one_title_size}px !important;\n line-height: normal;";
                    }
                    $variant = calculateFontWeight($font_family['variant']);
                    if (!empty($variant['style'])) : ?> font-style: <?php echo esc_html($variant['style']); ?> !important;
            <?php endif;
                    if (!empty($variant['weight'])) : ?> font-weight: <?php echo esc_html($variant['weight']); ?> !important;
            <?php endif; ?>
            }

    <?php }
    } ?>

    #topmenu > ul > li > a {
    <?php if (cs_get_option('menu_item_family')) {

        $font_family = cs_get_option('menu_item_family');
        if (!empty($font_family['family'])) { ?> font-family: "<?php echo esc_html($font_family['family']); ?>", sans-serif !important;
        <?php }

            $variant = calculateFontWeight($font_family['variant']);
            if (!empty($variant['style'])) : ?> font-style: <?php echo esc_html($variant['style']); ?> !important;
        <?php endif;
            if (!empty($variant['weight'])) : ?> font-weight: <?php echo esc_html($variant['weight']); ?> !important;
        <?php endif;
        }
        if (cs_get_option('menu_item_size')) {
            $menu_item_size = get_number_str(cs_get_option('menu_item_size'));  ?> font-size: <?php echo esc_html($menu_item_size); ?>px !important;
    <?php }
    if (cs_get_option('menu_line_height')) {
        $menu_line_height = get_number_str(cs_get_option('menu_line_height'));  ?> line-height: <?php echo esc_html($menu_line_height); ?>px !important;
    <?php } ?>
    }

    #topmenu ul ul li a {
    <?php if (cs_get_option('submenu_item_family')) {
        $font_family = cs_get_option('submenu_item_family');
        if (!empty($font_family['family'])) { ?> font-family: "<?php echo esc_html($font_family['family']); ?>", sans-serif !important;
        <?php }
            $variant = calculateFontWeight($font_family['variant']);
            if (!empty($variant['style'])) : ?> font-style: <?php echo esc_html($variant['style']); ?> !important;
        <?php endif;
            if (!empty($variant['weight'])) : ?> font-weight: <?php echo esc_html($variant['weight']); ?> !important;
        <?php endif;
        }
        if (cs_get_option('submenu_item_size')) {
            $submenu_item_size = get_number_str(cs_get_option('submenu_item_size')); ?> font-size: <?php echo esc_html($submenu_item_size); ?>px !important;
    <?php }

    if (cs_get_option('submenu_line_height')) {
        $submenu_line_height = get_number_str(cs_get_option('submenu_line_height'));  ?> line-height: <?php echo esc_html($submenu_line_height); ?>px !important;
    <?php } ?>
    }

    <?php if (cs_get_option('preloader_image')) :
        $image_src = wp_get_attachment_image_url(cs_get_option('preloader_image'), 'full', false);
        ?>

        @-webkit-keyframes scaleout-image {
        0% {
        -webkit-transform: scale(0.5);
        }
        100% {
        -webkit-transform: scale(1);
        opacity: 0;
        }
        }

        @keyframes scaleout-image {
        0% {
        transform: scale(0.5);
        -webkit-transform: scale(0.5);
        }
        100% {
        transform: scale(1);
        -webkit-transform: scale(1);
        opacity: 0;
        }
        }

        .animsition-loading {
        background-color: white;
        z-index: 9999;
        background-image: url(<?php echo esc_url($image_src); ?>) !important;
        background-repeat: no-repeat !important;
        background-position: center center !important;
        }

        .animsition-loading:before {
        display: none;
        }

    <?php endif; ?>