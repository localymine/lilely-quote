<style>
.logmod {
    /*background: rgba(0, 0, 0, 0.2) none repeat scroll 0 0;*/
    bottom: 0;
    display: block;
    left: 0;
    opacity: 1;
    /*position: fixed;*/
    right: 0;
    top: 0;
    z-index: 1;
}
.logmod::after {
    clear: both;
    content: "";
    display: table;
}
.logmod__wrapper {
    background: #fff none repeat scroll 0 0;
    border-radius: 4px;
    box-shadow: 0 0 18px rgba(0, 0, 0, 0.2);
    display: block;
    margin: 120px auto;
    max-width: 550px;
    position: relative;
}
.logmod__close {
    background: transparent url("http://imgh.us/close_white.svg") no-repeat scroll 0 0;
    cursor: pointer;
    display: block;
    height: 48px;
    margin-right: -24px;
    overflow: hidden;
    position: absolute;
    right: 50%;
    text-indent: 100%;
    top: -72px;
    white-space: nowrap;
    width: 48px;
}
.logmod__container {
    overflow: hidden;
    width: 100%;
}
.logmod__container::after {
    clear: both;
    content: "";
    display: table;
}
.logmod__tab {
    height: 0;
    opacity: 0;
    overflow: hidden;
    position: relative;
    visibility: hidden;
    width: 100%;
}
.logmod__tab-wrapper {
    height: auto;
    overflow: hidden;
    width: 100%;
}
.logmod__tab.show {
    height: 100%;
    opacity: 1;
    visibility: visible;
}
.logmod__tabs {
    list-style: outside none none;
    margin: 0;
    padding: 0;
}
.logmod__tabs::after {
    clear: both;
    content: "";
    display: table;
}
.logmod__tabs li.current a {
    background: #fff none repeat scroll 0 0;
    color: #333;
}
.logmod__tabs li a {
    background: #d2d8d8 none repeat scroll 0 0;
    color: #809191;
    cursor: pointer;
    float: left;
    font-size: 16px;
    font-weight: 700;
    height: 72px;
    line-height: 72px;
    position: relative;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    width: 50%;
}
.logmod__tabs li a:focus {
    outline: 1px dotted;
}
.logmod__heading {
    padding: 12px 0;
    text-align: center;
}
.logmod__heading-subtitle {
    color: #888;
    display: block;
    font-size: 15px;
    font-weight: 400;
    line-height: 48px;
}
.logmod__form {
    border-top: 1px solid #e5e5e5;
}
.logmod__alter {
    display: block;
    margin-top: 7px;
    position: relative;
}
.logmod__alter::after {
    clear: both;
    content: "";
    display: table;
}
.logmod__alter .connect:last-child {
    border-radius: 0 0 4px 4px;
}
.connect {
    display: block;
    height: 72px;
    line-height: 72px;
    overflow: hidden;
    position: relative;
    text-decoration: none;
    width: 100%;
}
.connect::after {
    clear: both;
    content: "";
    display: table;
}
.connect:focus, .connect:hover, .connect:visited {
    color: #fff;
    text-decoration: none;
}
.connect__icon {
    float: left;
    font-size: 22px;
    text-align: center;
    vertical-align: middle;
    width: 70px;
}
.connect__context {
    text-align: center;
    vertical-align: middle;
}
.connect.facebook {
    background: #3b5998 none repeat scroll 0 0;
    color: #fff;
}
.connect.facebook a {
    color: #fff;
}
.connect.facebook .connect__icon {
    background: #283d68 none repeat scroll 0 0;
}
.connect.googleplus {
    background: #dd4b39 none repeat scroll 0 0;
    color: #fff;
}
.connect.googleplus a {
    color: #fff;
}
.connect.googleplus .connect__icon {
    background: #b52f1f none repeat scroll 0 0;
}
.simform {
    position: relative;
}
.simform__actions {
    font-size: 14px;
    padding: 15px;
}
.simform__actions::after {
    clear: both;
    content: "";
    display: table;
}
.simform__actions .sumbit {
    background: #4caf50 none repeat scroll 0 0;
    color: #fff;
    float: right;
    font-size: 16px;
    font-weight: 700;
    height: 48px;
    margin-top: 7px;
    width: 50%;
}
.simform__actions .sumbit::after {
    clear: both;
    content: "";
    display: table;
}
.simform__actions-sidetext {
    color: #8c979e;
    display: inline-block;
    float: left;
    line-height: 24px;
    margin: 9px 0 0;
    padding: 0 10px;
    text-align: center;
    width: 50%;
}
.simform__actions-sidetext::after {
    clear: both;
    content: "";
    display: table;
}
.sminputs {
    border-bottom: 1px solid #e5e5e5;
}
.sminputs::after {
    clear: both;
    content: "";
    display: table;
}
.sminputs .input {
    -moz-appearance: none;
    background-color: #fff;
    border-bottom: medium none;
    border-radius: 0;
    border-right: 1px solid #e5e5e5;
    box-sizing: border-box;
    display: block;
    float: left;
    height: 71px;
    padding: 11px 24px;
    position: relative;
    width: 50%;
}
.sminputs .input.active {
    background: #eee none repeat scroll 0 0;
}
.sminputs .input.active .hide-password {
    background: #eee none repeat scroll 0 0;
}
.sminputs .input.full {
    width: 100%;
}
.sminputs .input label {
    cursor: pointer;
    display: block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    line-height: 24px;
    overflow: hidden;
    text-overflow: ellipsis;
    text-transform: uppercase;
    white-space: nowrap;
    width: 100%;
}
.sminputs .input input {
    background-color: transparent;
    border: medium none;
    border-radius: 4px;
    box-shadow: none;
    box-sizing: border-box;
    color: rgba(75, 89, 102, 0.85);
    cursor: pointer;
    display: inline-block;
    font-size: 15px;
    height: auto;
    line-height: 19.2px;
    padding: 0;
    vertical-align: middle;
    width: 100%;
}
.sminputs .hide-password {
    background: #fff none repeat scroll 0 0;
    border-left: 1px solid #e4e4e4;
    color: #444;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    line-height: 48px;
    margin-top: 12px;
    overflow: hidden;
    padding: 0 15px;
    position: absolute;
    right: 0;
    top: 0;
}
html {
    font-family: "Lato",sans-serif;
    font-size: 16px;
    line-height: 24px;
}
.btn, .simform__actions .sumbit {
    border: medium none;
    box-shadow: none;
    box-sizing: border-box;
    cursor: pointer;
    display: inline-block;
    font-weight: 400;
    line-height: normal;
    min-width: 90px;
    outline: medium none;
    outline-offset: 0;
    padding: 10px 14px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}
.btn.full, .simform__actions .full.sumbit {
    width: 100%;
}
.btn.lg, .simform__actions .lg.sumbit {
    font-size: 22px;
    line-height: 1.3;
    min-width: 125px;
    padding: 17px 14px;
}
.btn.sm, .simform__actions .sm.sumbit {
    font-size: 14px;
    min-width: 65px;
    padding: 4px 12px;
}
.btn.xs, .simform__actions .xs.sumbit {
    font-size: 10px;
    line-height: 1.5;
    min-width: 45px;
    padding: 2px 10px;
}
.btn.circle, .simform__actions .circle.sumbit {
    border-radius: 50%;
    height: 56px;
    line-height: 1;
    min-width: 56px;
    overflow: hidden;
    padding: 0;
    width: 56px;
}
.btn.circle.lg, .simform__actions .circle.lg.sumbit {
    height: 78px;
    min-width: 78px;
    width: 78px;
}
.btn.circle.sm, .simform__actions .circle.sm.sumbit {
    height: 40px;
    min-width: 40px;
    width: 40px;
}
.btn.circle.xs, .simform__actions .circle.xs.sumbit {
    height: 30px;
    min-width: 30px;
    width: 30px;
}
.btn:focus, .simform__actions .sumbit:focus, .btn:active, .simform__actions .sumbit:active, .btn.active, .simform__actions .active.sumbit, .btn:active:focus, .simform__actions .sumbit:active:focus, .btn.active:focus, .simform__actions .active.sumbit:focus {
    box-shadow: none;
    outline: 0 none;
    outline-offset: 0;
}
.btn.red, .simform__actions .red.sumbit {
    background: #f44336 none repeat scroll 0 0;
    color: #fff;
}
.btn.red:active, .simform__actions .red.sumbit:active, .btn.red:focus, .simform__actions .red.sumbit:focus {
    background-color: #ef1d0d;
}
.btn.red:hover, .simform__actions .red.sumbit:hover {
    background-color: #f32c1e;
}
.btn.pink, .simform__actions .pink.sumbit {
    background: #e91e63 none repeat scroll 0 0;
    color: #fff;
}
.btn.pink:active, .simform__actions .pink.sumbit:active, .btn.pink:focus, .simform__actions .pink.sumbit:focus {
    background-color: #c61350;
}
.btn.pink:hover, .simform__actions .pink.sumbit:hover {
    background-color: #d81557;
}
.btn.purple, .simform__actions .purple.sumbit {
    background: #9c27b0 none repeat scroll 0 0;
    color: #fff;
}
.btn.purple:active, .simform__actions .purple.sumbit:active, .btn.purple:focus, .simform__actions .purple.sumbit:focus {
    background-color: #7b1f8a;
}
.btn.purple:hover, .simform__actions .purple.sumbit:hover {
    background-color: #89229b;
}
.btn.deep-purple, .simform__actions .deep-purple.sumbit {
    background: #673ab7 none repeat scroll 0 0;
    color: #fff;
}
.btn.deep-purple:active, .simform__actions .deep-purple.sumbit:active, .btn.deep-purple:focus, .simform__actions .deep-purple.sumbit:focus {
    background-color: #532f94;
}
.btn.deep-purple:hover, .simform__actions .deep-purple.sumbit:hover {
    background-color: #5c34a4;
}
.btn.indigo, .simform__actions .indigo.sumbit {
    background: #3f51b5 none repeat scroll 0 0;
    color: #fff;
}
.btn.indigo:active, .simform__actions .indigo.sumbit:active, .btn.indigo:focus, .simform__actions .indigo.sumbit:focus {
    background-color: #334293;
}
.btn.indigo:hover, .simform__actions .indigo.sumbit:hover {
    background-color: #3849a2;
}
.btn.blue, .simform__actions .blue.sumbit {
    background: #2196f3 none repeat scroll 0 0;
    color: #fff;
}
.btn.blue:active, .simform__actions .blue.sumbit:active, .btn.blue:focus, .simform__actions .blue.sumbit:focus {
    background-color: #0c7fda;
}
.btn.blue:hover, .simform__actions .blue.sumbit:hover {
    background-color: #0d8aee;
}
.btn.light-blue, .simform__actions .light-blue.sumbit {
    background: #03a9f4 none repeat scroll 0 0;
    color: #fff;
}
.btn.light-blue:active, .simform__actions .light-blue.sumbit:active, .btn.light-blue:focus, .simform__actions .light-blue.sumbit:focus {
    background-color: #028ac7;
}
.btn.light-blue:hover, .simform__actions .light-blue.sumbit:hover {
    background-color: #0398db;
}
.btn.cyan, .simform__actions .cyan.sumbit {
    background: #00bcd4 none repeat scroll 0 0;
    color: #fff;
}
.btn.cyan:active, .simform__actions .cyan.sumbit:active, .btn.cyan:focus, .simform__actions .cyan.sumbit:focus {
    background-color: #0093a6;
}
.btn.cyan:hover, .simform__actions .cyan.sumbit:hover {
    background-color: #00a5bb;
}
.btn.teal, .simform__actions .teal.sumbit {
    background: #009688 none repeat scroll 0 0;
    color: #fff;
}
.btn.teal:active, .simform__actions .teal.sumbit:active, .btn.teal:focus, .simform__actions .teal.sumbit:focus {
    background-color: #00685e;
}
.btn.teal:hover, .simform__actions .teal.sumbit:hover {
    background-color: #007d71;
}
.btn.green, .simform__actions .green.sumbit {
    background: #4caf50 none repeat scroll 0 0;
    color: #fff;
}
.btn.green:active, .simform__actions .green.sumbit:active, .btn.green:focus, .simform__actions .green.sumbit:focus {
    background-color: #3e8f41;
}
.btn.green:hover, .simform__actions .green.sumbit:hover {
    background-color: #449d48;
}
.btn.light-green, .simform__actions .light-green.sumbit {
    background: #8bc34a none repeat scroll 0 0;
    color: #fff;
}
.btn.light-green:active, .simform__actions .light-green.sumbit:active, .btn.light-green:focus, .simform__actions .light-green.sumbit:focus {
    background-color: #74a838;
}
.btn.light-green:hover, .simform__actions .light-green.sumbit:hover {
    background-color: #7eb73d;
}
.btn.lime, .simform__actions .lime.sumbit {
    background: #cddc39 none repeat scroll 0 0;
    color: #fff;
}
.btn.lime:active, .simform__actions .lime.sumbit:active, .btn.lime:focus, .simform__actions .lime.sumbit:focus {
    background-color: #b6c423;
}
.btn.lime:hover, .simform__actions .lime.sumbit:hover {
    background-color: #c6d626;
}
.btn.yellow, .simform__actions .yellow.sumbit {
    background: #ffeb3b none repeat scroll 0 0;
    color: #fff;
}
.btn.yellow:active, .simform__actions .yellow.sumbit:active, .btn.yellow:focus, .simform__actions .yellow.sumbit:focus {
    background-color: #ffe60d;
}
.btn.yellow:hover, .simform__actions .yellow.sumbit:hover {
    background-color: #ffe821;
}
.btn.amber, .simform__actions .amber.sumbit {
    background: #ffc107 none repeat scroll 0 0;
    color: #fff;
}
.btn.amber:active, .simform__actions .amber.sumbit:active, .btn.amber:focus, .simform__actions .amber.sumbit:focus {
    background-color: #d8a200;
}
.btn.amber:hover, .simform__actions .amber.sumbit:hover {
    background-color: #ecb100;
}
.btn.orange, .simform__actions .orange.sumbit {
    background: #ff9800 none repeat scroll 0 0;
    color: #fff;
}
.btn.orange:active, .simform__actions .orange.sumbit:active, .btn.orange:focus, .simform__actions .orange.sumbit:focus {
    background-color: #d17d00;
}
.btn.orange:hover, .simform__actions .orange.sumbit:hover {
    background-color: #e68900;
}
.btn.deep-orange, .simform__actions .deep-orange.sumbit {
    background: #ff5722 none repeat scroll 0 0;
    color: #fff;
}
.btn.deep-orange:active, .simform__actions .deep-orange.sumbit:active, .btn.deep-orange:focus, .simform__actions .deep-orange.sumbit:focus {
    background-color: #f33a00;
}
.btn.deep-orange:hover, .simform__actions .deep-orange.sumbit:hover {
    background-color: #ff4408;
}
.btn.brown, .simform__actions .brown.sumbit {
    background: #795548 none repeat scroll 0 0;
    color: #fff;
}
.btn.brown:active, .simform__actions .brown.sumbit:active, .btn.brown:focus, .simform__actions .brown.sumbit:focus {
    background-color: #5c4137;
}
.btn.brown:hover, .simform__actions .brown.sumbit:hover {
    background-color: #694a3e;
}
.btn.grey, .simform__actions .grey.sumbit {
    background: #9e9e9e none repeat scroll 0 0;
    color: #fff;
}
.btn.grey:active, .simform__actions .grey.sumbit:active, .btn.grey:focus, .simform__actions .grey.sumbit:focus {
    background-color: #878787;
}
.btn.grey:hover, .simform__actions .grey.sumbit:hover {
    background-color: #919191;
}
.btn.blue-grey, .simform__actions .blue-grey.sumbit {
    background: #607d8b none repeat scroll 0 0;
    color: #fff;
}
.btn.blue-grey:active, .simform__actions .blue-grey.sumbit:active, .btn.blue-grey:focus, .simform__actions .blue-grey.sumbit:focus {
    background-color: #4d6570;
}
.btn.blue-grey:hover, .simform__actions .blue-grey.sumbit:hover {
    background-color: #566f7c;
}
.special {
    color: #f44336;
    position: relative;
    text-decoration: none;
    transition: all 0.15s ease-out 0s;
}
.special::before {
    background: #f00 none repeat scroll 0 0;
    bottom: 0;
    content: "";
    height: 1px;
    left: 0;
    position: absolute;
    transform: scaleX(0);
    transition: all 0.3s ease-in-out 0s;
    visibility: hidden;
    width: 100%;
}
.special:hover {
    transition: all 0.15s ease-out 0s;
}
.special:hover::before {
    transform: scaleX(1);
    visibility: visible;
}
#baseline {
    background-image: url("http://basehold.it/i/24");
    bottom: 0;
    height: 100%;
    left: 0;
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    z-index: 999999;
}
.bb-box{
    position: absolute;
    width: 300px;
    padding: 25px;
    font-size: 16px;
    box-shadow: 0 0 18px rgba(181, 47, 31, 0.2) inset;
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    text-align: justify;
}
.bb-left{
    /*background: none repeat scroll 0 0 rgba(239, 85, 57, 0.07);*/
    background: #D4DEDF;
    box-shadow: 0 1px 2px rgba(34, 25, 25, 0.4);
    /*background: -webkit-linear-gradient(90deg, #b52f1f, #dd4b39);*/
    background: -webkit-linear-gradient(90deg, #D4DEDF, #DCDCDE);
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    color: #333;
    font-size: 33.8px;
    margin-top: 60px;
}
.bb-right{
    right: 20px;
    background: #D4DEDF;
    box-shadow: 0 1px 2px rgba(34, 25, 25, 0.4);
    /*background: -webkit-linear-gradient(90deg, #b52f1f, #dd4b39);*/
    background: -webkit-linear-gradient(90deg, #D4DEDF, #DCDCDE);
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    color: #333;
    font-size: 24px;
    margin-top: 60px;
}
</style>
<div class="gallery show-content">
    <div class="bb-box bb-left">
        Sign up now to create your profile and begin sharing inspirational ideas with like minded people
    </div>
    <div class="bb-box bb-right">
        Join our Premium Plan today to receive daily inspirational videos delivered to your inbox. The Premium Plan is an annual $5 fee. Just five dollars to start your day with inspiration
    </div>
<div class="logmod">
    <div class="logmod__wrapper">
        <!--<span class="logmod__close">Close</span>-->
        <div class="logmod__container">
            <ul class="logmod__tabs">
                <li data-tabtar="lgm-2" class="current"><a href="#">Login</a></li>
                <li data-tabtar="lgm-1" class=""><a href="#">Sign Up</a></li>
            </ul>
            <div class="logmod__tab-wrapper">
                <div class="logmod__tab lgm-1">
                    <div class="logmod__heading">
                        <span class="logmod__heading-subtitle">Enter your personal details <strong>to create an acount</strong></span>
                    </div>
                    <div class="logmod__form">
                        <form class="simform" action="#" accept-charset="utf-8">
                            <div class="sminputs">
                                <div class="input full">
                                    <label for="user-name" class="string optional">Email*</label>
                                    <input type="email" size="50" placeholder="Email" id="user-email" maxlength="255" class="string optional">
                                </div>
                            </div>
                            <div class="sminputs">
                                <div class="input string optional">
                                    <label for="user-pw" class="string optional">Password *</label>
                                    <input type="text" size="50" placeholder="Password" id="user-pw" maxlength="255" class="string optional">
                                </div>
                                <div class="input string optional">
                                    <label for="user-pw-repeat" class="string optional">Repeat password *</label>
                                    <input type="text" size="50" placeholder="Repeat password" id="user-pw-repeat" maxlength="255" class="string optional">
                                </div>
                            </div>
                            <div class="simform__actions">
                                <input type="sumbit" value="Create Account" name="commit" class="sumbit">
                                <span class="simform__actions-sidetext">By creating an account you agree to our <a role="link" target="_blank" href="#" class="special">Terms &amp; Privacy</a></span>
                            </div> 
                        </form>
                    </div> 
                    <div class="logmod__alter">
                        <div class="logmod__alter-container">
                            <a class="connect facebook" href="#">
                                <div class="connect__icon">
                                    <i class="fa fa-facebook"></i>
                                </div>
                                <div class="connect__context">
                                    <span>Create an account with <strong>Facebook</strong></span>
                                </div>
                            </a>

                            <a class="connect googleplus" href="#">
                                <div class="connect__icon">
                                    <i class="fa fa-google-plus"></i>
                                </div>
                                <div class="connect__context">
                                    <span>Create an account with <strong>Google+</strong></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="logmod__tab lgm-2 show">
                    <div class="logmod__heading">
                        <span class="logmod__heading-subtitle">Enter your email and password <strong>to sign in</strong></span>
                    </div> 
                    <div class="logmod__form">
                        <form class="simform" action="#" accept-charset="utf-8">
                            <div class="sminputs">
                                <div class="input full">
                                    <label for="user-name" class="string optional">Email*</label>
                                    <input type="email" size="50" placeholder="Email" id="user-email" maxlength="255" class="string optional">
                                </div>
                            </div>
                            <div class="sminputs">
                                <div class="input full">
                                    <label for="user-pw" class="string optional">Password *</label>
                                    <input type="password" size="50" placeholder="Password" id="user-pw" maxlength="255" class="string optional">
                                    <!--<span class="hide-password">Show</span>-->
                                </div>
                            </div>
                            <div class="simform__actions">
                                <input type="sumbit" value="Log In" name="commit" class="sumbit">
                                <span class="simform__actions-sidetext"><a href="#" role="link" class="special">Forgot your password?<br>Click here</a></span>
                            </div> 
                        </form>
                    </div> 
                    <div class="logmod__alter">
                        <div class="logmod__alter-container">
                            <a class="connect facebook" href="#">
                                <div class="connect__icon">
                                    <i class="fa fa-facebook"></i>
                                </div>
                                <div class="connect__context">
                                    <span>Sign in with <strong>Facebook</strong></span>
                                </div>
                            </a>
                            <a class="connect googleplus" href="#">
                                <div class="connect__icon">
                                    <i class="fa fa-google-plus"></i>
                                </div>
                                <div class="connect__context">
                                    <span>Sign in with <strong>Google+</strong></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
$script = <<< EOD
var LoginModalController = {
    tabsElementName: ".logmod__tabs li",
    tabElementName: ".logmod__tab",
    inputElementsName: ".logmod__form .input",
    hidePasswordName: ".hide-password",
    
    inputElements: null,
    tabsElement: null,
    tabElement: null,
    hidePassword: null,
    
    activeTab: null,
    tabSelection: 0, // 0 - first, 1 - second
    
    findElements: function () {
        var base = this;
        
        base.tabsElement = $(base.tabsElementName);
        base.tabElement = $(base.tabElementName);
        base.inputElements = $(base.inputElementsName);
        base.hidePassword = $(base.hidePasswordName);
        
        return base;
    },
    
    setState: function (state) {
    	var base = this,
            elem = null;
        
        if (!state) {
            state = 0;
        }
        
        if (base.tabsElement) {
        	elem = $(base.tabsElement[state]);
            elem.addClass("current");
            $("." + elem.attr("data-tabtar")).addClass("show");
        }
  
        return base;
    },
    
    getActiveTab: function () {
        var base = this;
        
        base.tabsElement.each(function (i, el) {
           if ($(el).hasClass("current")) {
               base.activeTab = $(el);
           }
        });
        
        return base;
    },
   
    addClickEvents: function () {
    	var base = this;
        
        base.hidePassword.on("click", function (e) {
            var \$this = $(this),
                \$pwInput = \$this.prev("input");
            
            if (\$pwInput.attr("type") == "password") {
                \$pwInput.attr("type", "text");
                \$this.text("Hide");
            } else {
                \$pwInput.attr("type", "password");
                \$this.text("Show");
            }
        });
 
        base.tabsElement.on("click", function (e) {
            var targetTab = $(this).attr("data-tabtar");
            
            e.preventDefault();
            base.activeTab.removeClass("current");
            base.activeTab = $(this);
            base.activeTab.addClass("current");
            
            base.tabElement.each(function (i, el) {
                el = $(el);
                el.removeClass("show");
                if (el.hasClass(targetTab)) {
                    el.addClass("show");
                }
            });
        });
        
        base.inputElements.find("label").on("click", function (e) {
           var \$this = $(this),
               \$input = \$this.next("input");
            
            \$input.focus();
        });
        
        return base;
    },
    
    initialize: function () {
        var base = this;
        
        base.findElements().setState().getActiveTab().addClickEvents();
    }
};

$(document).ready(function() {
    LoginModalController.initialize();
});
EOD;
//
Yii::app()->clientScript->registerScript('account-' . rand(), $script, CClientScript::POS_END);
?>