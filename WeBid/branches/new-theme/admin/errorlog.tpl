<!-- INCLUDE header.tpl -->
    	<div style="width:25%; float:left;">
            <div style="margin-left:auto; margin-right:auto;">
            	<div class="box">
                	<h4 class="rounded-top">{L_5436}</h4>
                    <div class="rounded-bottom">
                    	<ul class="menu">
                        	<li><a href="{SITEURL}admin/maintainance.php">{L__0001}</a></li>
                        	<li><a href="{SITEURL}admin/wordsfilter.php">{L_5068}</a></li>
                        	<li><a href="{SITEURL}admin/errorlog.php">{L_891}</a></li>
                        </ul>
                    </div>
                </div>
            	<div class="box">
                	<h4 class="rounded-top">Something</h4>
                    <div class="rounded-bottom">
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tincidunt varius elit non dapibus. Donec nec mauris quis metus volutpat pellentesque. Mauris justo lacus, porttitor non commodo non, tincidunt et velit. Suspendisse nulla elit, laoreet sit amet gravida vitae, iaculis interdum massa. Aliquam pretium turpis quis odio posuere id molestie risus adipiscing. Suspendisse nisi purus, feugiat quis pellentesque non, ultricies sed metus. Sed mollis leo et leo auctor gravida. Aenean accumsan lacus ut erat viverra bibendum. Nulla eu gravida quam. Phasellus sit amet est massa. Nulla pellentesque facilisis velit dignissim euismod. Sed tincidunt quam eget lorem placerat commodo. Proin ultrices, lectus rutrum posuere tincidunt, ante urna vulputate nulla, id malesuada risus nulla ut odio.
                    </div>
                </div>
            </div>
        </div>
    	<div style="width:75%; float:right;">
            <div style="margin-left:auto; margin-right:auto; border:#000 1px solid; padding: 5px;">
            	{L_5436}&nbsp;&gt;&gt;&nbsp;{L_891}
				<form name="errorlog" action="" method="post">
<!-- IF ERROR ne '' -->
					<div class="error-box"><b>{ERROR}</b></div>
<!-- ENDIF -->
                    <div style="margin:10px; overflow:scroll; height:500px; width: 98%;">
                    	{ERRORLOG}
                    </div>
                    <input type="hidden" name="action" value="clearlog">
                    <input type="submit" name="act" class="centre" value="{L_890}">
				</form>
            </div>
        </div>
<!-- INCLUDE footer.tpl -->