<?php
header("Content-type: text/css; charset: UTF-8");
if(isset($_GET['color']))
{
  $color = '#'.$_GET['color'];
}
else {
  $color = '#FF9900';
}
?>


a,
a:hover,
a:active,
a:focus,
.title-head span,
body.light .navbar-nav>li .dropdown-menu a:hover,
body.light .latest-post .post-title a:hover,
.site-navigation ul.nav.nav-tabs li.active a:hover, .site-navigation ul.nav.nav-tabs li.active a,
ul.navbar-nav > li:hover > a,
body.light ul.navbar-nav > li:hover > a,
.navbar-nav .fa-search:hover,
.navbar-nav .fa-search:active,
.navbar-nav .fa-search:focus,
body.light .navbar-nav .fa-search:hover,
body.light .navbar-nav .fa-search:active,
body.light .navbar-nav .fa-search:focus,
ul.navbar-nav > li.active > a,
.about-content ul.nav.nav-tabs li.active a,
.dropdown-menu>.active>a, 
.dropdown-menu>.active>a:hover, 
.dropdown-menu>.active>a:focus, 
.dropdown-menu>.active>.dropdown-menu>.active>a,
.dropdown-menu li a:hover, 
.dropdown-menu li a:focus,
body.light .dropdown-menu>.active>a, 
.slider-text .slide-title span,
#main-slide .carousel-control i,
.feature .feature-icon,
.button-video,
.facts-footer > div h5,
.bitcoin-calculator-section h3 span,
.team-member-caption .list li a:hover,
.team .social-icons ul.social li a:hover:before,
blockquote p:before, blockquote p:after,
blockquote footer span,
.latest-post .post-title a:hover,
.footer .top-footer h4,
.footer .bottom-footer p span,
.breadcrumb>li a:hover,
.user-auth > div:nth-child(2) .form-container .form-group a:hover,
.sidebar ul.nav-tabs li a:hover,
body.light.blog .sidebar ul.nav-tabs li a:hover,
.widget.recent-posts .entry-title a:hover,
body.light.blog .widget.recent-posts .entry-title a:hover,
body.blog article h4:hover,
.comments-list .comment-reply,
body.blog .meta span i,
body.blog .meta a,
ul.user li.sign-in a,
.slider.btn-primary,
.countdown-amount,
h4.panel-title a,
.contact-page-info .contact-info-box i.big-icon,
.facts .facts-content .heading-facts h2 span,
.btn-primary.btn-pricing,
.shop-cart .table .icon-delete-product:hover,
.shop-cart .table .icon-delete-product:focus, 
.shop-cart .table .icon-delete-product:active,
body.light .shop-cart .table .icon-delete-product:hover,
body.light .shop-cart .table .icon-delete-product:focus, 
body.light .shop-cart .table .icon-delete-product:active
.shop-cart .btn.btn-primary.btn-coupon:hover,
.shop-cart .btn.btn-primary.btn-coupon:focus,
.shop-cart .btn.btn-primary.btn-coupon:active,
.shop-cart .btn.btn-update-cart:hover,
.shop-cart .btn.btn-update-cart:focus,
.shop-cart .btn.btn-update-cart:active,
.shop-cart .btn.btn-coupon:hover,
.payment .tooltip-text {
  color: <?php echo $color?>;
}

.pricing .single-pricebox .plan-title{
  color: <?php echo $color?>;
}

.pricing .single-pricebox {
  border: 1px solid <?php echo $color?>;
}

.pricing .single-pricebox .bonus .persent {
  color: <?php echo $color?>;
}

.order-details .order-details-box .header .title {
  color: <?php echo $color?>;
}

.form-control {
  color: <?php echo $color?>;
}

.dashbord-content .transaction-area .heading-area .title {
  color: <?php echo $color?>;
}

.tabl-text tbody tr td, .tabl-text thead tr th {
    border-bottom: 1px solid <?php echo $color?> !important;
    border-top: 1px solid <?php echo $color?> !important;
}

.tabl-text {
  color: <?php echo $color?>;
}

.current-balance .content .amount {
  color: <?php echo $color?>;
}

.table th {
  border-bottom: 1px solid <?php echo $color?> !important;
}

.table td, .table th {
  border-top: 1px solid <?php echo $color?> !important;
}

.left-amount {
    box-shadow: 6px 10px 11px <?php echo $color?>;
}

label.bmd-label-floating {
  color: <?php echo $color?>;
}

.profile .profile-image-area .content .name {
  color: <?php echo $color?>;
}

.range-slider__range{
  background: linear-gradient(90deg, <?php echo $color?> 46.4444%, rgba(31, 113, 212, 0.125) 46.5444%);
}

input[type=range]::-webkit-slider-thumb {
  -webkit-appearance: none;
  height: 16px;
  width: 16px;
  border-radius: 50%;
  background: <?php echo $color?>;
}

input[type=range]::-moz-range-thumb {
  height: 16px;
  width: 16px;
  border-radius: 50%;
  background: <?php echo $color?>;
}

input[type=range]::-ms-thumb {
  height: 16px;
  width: 16px;
  border-radius: 50%;
  background: <?php echo $color?>;
}

.btn-primary,
.title-head-subtitle p:before,
.title-head-subtitle p:after,
body.light ul.user li.sign-in a:hover,
ul.user li.sign-in a:hover,
.navbar-toggle,
.slider.btn-primary:hover,
.pricing-switcher .switch,
.bitcoin-calculator .form-input.select-currency,
.bitcoin-calculator .form-info,
.team-member:hover .team-member-caption,
.select-primary~.select2 .select2-selection__rendered,
.select-primary~.select2 .select2-selection__rendered,.select-primary~.select2 .select2-selection__rendered:active,
.select-primary~.select2 .select2-selection__rendered:focus,
.select-primary~.select2 .select2-selection__rendered:hover,
.select-primary-dropdown,
#carousel-testimonials .carousel-indicators li.active,
.widget-tags ul > li a:hover,
body.blog .pagination li.active a,
.facts,
.call-action-all .action-btn .btn-primary {
  background: <?php echo $color?>;
}

ul.user li.sign-in a:hover,
.bitcoin-calculator .form-info,
.widget-tags ul > li a:hover,
body.blog .pagination li.active a,
ul.user li.sign-in a,
.slider.btn-primary,
.btn-primary.btn-pricing,
.shop-cart .btn.btn-primary.btn-coupon:hover,
.shop-cart .btn.btn-primary.btn-coupon:focus,
.shop-cart .btn.btn-primary.btn-coupon:active,
.shop-cart .btn.btn-update-cart:hover,
.shop-cart .btn.btn-update-cart:focus,
.shop-cart .btn.btn-update-cart:active{
  border: 1px solid <?php echo $color?>;
}

.bitcoin-calculator span.select2,
.select2-container--default .select2-selection--single {
  border-bottom: 1px solid <?php echo $color?>;
}

body.light ul.user li.sign-in a:hover, .slider.btn-primary:hover {
  border: 1px solid <?php echo $color?>;
}

.team-member-caption {
  border-top: 3px solid <?php echo $color?>;
}

.button-video:after {
  border-color: transparent transparent transparent <?php echo $color?>;
}

.btcwdgt-chart .btcwdgt-header h2 {
  background-color: <?php echo $color?> !important;
}

.path {
  stroke: <?php echo $color?>;
}

@-webkit-keyframes dash {
  0% {
    stroke-dashoffset: 2000;
    opacity: 0;
    stroke: <?php echo $color?>;
  }

  15% {
    opacity: 1;
    stroke: <?php echo $color?>;
  }

  70% {
    opacity: 1;
    stroke: <?php echo $color?>;
  }

  100% {
    stroke-dashoffset: 0;
    opacity: 0;
    stroke: <?php echo $color?>;
  }
}

@keyframes dash {
  0% {
    stroke-dashoffset: 2000;
    opacity: 0;
    stroke: <?php echo $color?>;
  }

  15% {
    opacity: 1;
    stroke: <?php echo $color?>;
  }

  70% {
    opacity: 1;
    stroke:<?php echo $color?>;
  }

  100% {
    stroke-dashoffset: 0;
    opacity: 0;
    stroke: <?php echo $color?>;
  }
}

.btcwdgt.btcwdgt-s-price .btcwdgt-body ul li {
  color: <?php echo $color?> !important;
}

.btcwdgt.btcwdgt-chart .btcwdgt-header h2,
.btcwdgt.btcwdgt-chart .btcwdgt-header .stats {
  background-color: <?php echo $color?> !important;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
  background: <?php echo $color?> !important;
  outline: none !important;
}

.slider.btn-primary:focus,
.slider.btn-primary:active,
ul.user li.sign-in a.btn-primary:focus,
ul.user li.sign-in a.btn-primary:active {
  border: 1px solid <?php echo $color?> !important;
}

@media (max-width : 767px) {
 
  ul.navbar-nav > li.active, ul.navbar-nav > li:not(.search):hover {
    background: transparent;
  }

  .site-navigation.fixed ul.navbar-nav {
    border: 0;
  }

  .site-navigation {
    border-bottom: 1px solid #333;
  }

  body.light .navbar-collapse ul.navbar-nav > li.active > a, .navbar-collapse ul.navbar-nav > li.active > a {
    color: <?php echo $color?>;
  }
}

@media (max-width : 570px) {
 
  .about-content ul.nav.nav-tabs li.active a {
    color: #fff;
  }

  ul.nav.nav-tabs li.active a:hover, ul.nav.nav-tabs li.active a {
    background: <?php echo $color?>;
  }

  ul.nav.nav-tabs li.active {
    border-bottom: 1px solid <?php echo $color?>;
  }
  .facts {
	  background:#222;
  }
  body.light .facts {
	  background:#e7e7e7;
  }
}