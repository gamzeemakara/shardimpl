$(function() {

    var newHash = "",
	$mainContent = $("#main-content"),
	$pageWrap    = $("#page-wrap"),
	baseHeight   = 0,
	$el;
        
    $pageWrap.height($pageWrap.height());
    baseHeight = $pageWrap.height() - $mainContent.height();
    
    $("#stepbutton").live( "click", function() {
		switch(parseInt($('form input[name="step"]').attr("value"))){
			case 2:
				var success = $.getJSON("json/get.php?info=me", 
				function(json){
					if(json.hasVotedOnAllLinks != 1){
						displayError("Please vote on all the links.");
					} else {
						var fields = $("form :input").serializeArray();
						var newhash = "?";
						jQuery.each(fields, function(i, field){
							newhash = newhash + field.name + "=" + field.value + "&";
						});
						window.location.hash = newhash;
					}
				});
				return false;
			case 3:
				if(!$("form input[name='rewards']:checked").val()){
					displayError("Please select a reward.");
					return false;
				} else if($("form input[name='username']").val().length == 0){
					displayError("Please input your in game name.");
					return false;
				}
				break;
		}
        //window.location.hash = "?step=" + $('form input[name="step"]').attr("value");
		var fields = $("form :input").serializeArray();
		var newhash = "?";
		jQuery.each(fields, function(i, field){
			newhash = newhash + field.name + "=" + field.value.replace(/ /g,'_') + "&";
		});
		window.location.hash = newhash;
        return false;
    });
	
	if(!window.location.hash){
		window.location.hash = "#?step=1";
	}
	
    $(window).bind('hashchange', function(){
    
        newHash = window.location.hash.substring(1);
		
        if (newHash) {
            $mainContent
                .find("#guts")
                .fadeOut(200, function() {
                    $mainContent.hide().load(newHash + " #guts", function() {
                            $pageWrap.animate({
                                height: baseHeight + $mainContent.outerHeight() + "px"
                            });
						$mainContent.fadeIn(1000);
                        /*$("nav a").removeClass("current");
                        $('nav a[href="'+newHash+'"]').addClass("current");*/
                    });
                });
        };
    });
	/***/
    
    $(window).trigger('hashchange');
	function displayError(msg){
		noty({"text":msg,"layout":"bottom","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
	}
	//failToVote();
	
    $("#rewards tbody tr").live("click", function() {
		
		$('input:radio[name=rewards]').filter('[value='+$(this).attr("current")+']').attr('checked', true);
		$('#rewards tr').removeClass('active');
		$(this).addClass('active');
    });
});
	
	function startCountDown(time){
		var dthen = new Date(new Date().getTime()+(time*1000));
		var dnow = new Date();
		gsecs = Math.floor(new Date(dthen-dnow)/1000);
		CountBack(gsecs);
	}
	
	function calcage(secs, num1, num2) {
	  s = ((Math.floor(secs/num1))%num2).toString();
	  if (s.length < 2)
		s = "0" + s;
	  return "<b>" + s + "</b>";
	}

	function CountBack(secs) {
	  if (secs < 0) {
		document.getElementById("cntdwn").innerHTML = "You can now vote!";
		return;
	  }
	  DisplayStr = "<br/>%%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
	  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
	  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
	  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));
	  document.getElementById("cntdwn").innerHTML = DisplayStr;
	  setTimeout("CountBack(" + (secs-1) + ")", 990);
	}