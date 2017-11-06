
var stickyAnythingBreakpoint = '' // solely to use as a debugging breakpoint, if needed.
!function(e){function t(t,i,n,l,s,o,r,d){$listenerElement=e(".sticky-element-active");var c=$listenerElement.offset();if(orgElementTop=c.top,s){var a=e(s).offset();pushElementTop=a.top}var m=window,g="inner";if("innerWidth"in window||(g="client",m=document.documentElement||document.body),viewport=m[g+"Width"],o&&e("body").hasClass("admin-bar")&&viewport>600?adminBarHeight=e("#wpadminbar").height():adminBarHeight=0,e(window).scrollTop()>=orgElementTop-t-adminBarHeight&&viewport>=i&&viewport<=n){coordsOrgElement=$listenerElement.offset(),leftOrgElement=coordsOrgElement.left,widthPlaceholder=$listenerElement[0].getBoundingClientRect().width,widthPlaceholder||(widthPlaceholder=$listenerElement.css("width")),heightPlaceholder=$listenerElement[0].getBoundingClientRect().height,heightPlaceholder||(heightPlaceholder=$listenerElement.css("height")),widthSticky=e(".sticky-element-original").css("width"),"0px"==widthSticky&&(widthSticky=e(".sticky-element-original")[0].getBoundingClientRect().width),heightSticky=e(".sticky-element-original").height(),paddingOrgElement=[e(".sticky-element-original").css("padding-top"),e(".sticky-element-original").css("padding-right"),e(".sticky-element-original").css("padding-bottom"),e(".sticky-element-original").css("padding-left")],paddingSticky=paddingOrgElement[0]+" "+paddingOrgElement[1]+" "+paddingOrgElement[2]+" "+paddingOrgElement[3],marginOrgElement=[$listenerElement.css("margin-top"),$listenerElement.css("margin-right"),$listenerElement.css("margin-bottom"),$listenerElement.css("margin-left")],marginPlaceholder=marginOrgElement[0]+" "+marginOrgElement[1]+" "+marginOrgElement[2]+" "+marginOrgElement[3],assignedStyles="";for(var h in r)"inline"==r[h]?assignedStyles+=h+":inline-block; ":assignedStyles+=h+":"+r[h]+"; ";elementHeight=0,heightPlaceholder<1?elementHeight=e(".sticky-element-cloned").outerHeight():elementHeight=e(".sticky-element-original").outerHeight(),s&&e(window).scrollTop()>pushElementTop-t-elementHeight-adminBarHeight?stickyTopMargin=pushElementTop-t-elementHeight-e(window).scrollTop():stickyTopMargin=adminBarHeight,assignedStyles+="width:"+widthPlaceholder+"px; height:"+heightPlaceholder+"px; margin:"+marginPlaceholder+";",e(".sticky-element-original").removeClass("sticky-element-active").css("position","fixed").css("left",leftOrgElement+"px").css("top",t+"px").css("width",widthSticky).css("margin-left",0).css("padding",paddingSticky).css("margin-top",stickyTopMargin).css("z-index",l),e(".sticky-element-placeholder").hasClass("sticky-element-active")||e(".sticky-element-placeholder").addClass("sticky-element-active").attr("style",assignedStyles)}else e(".sticky-element-original").addClass("sticky-element-active").attr("style",d),e(".sticky-element-placeholder").hasClass("sticky-element-active")&&e(".sticky-element-placeholder").removeClass("sticky-element-active").removeAttr("style").css("width","0").css("height","0").css("margin","0").css("padding","0")}function i(){e(".sticky-element-original").addClass("sticky-element-active").before('<div class="sticky-element-placeholder" style="width:0; height:0; margin:0; padding:0; visibility:hidden;"></div>')}function n(e){return o={},o.display=e.css("display"),o["float"]=e.css("float"),o.flex=e.css("flex"),o["box-sizing"]=e.css("box-sizing"),o.clear=e.css("clear"),o.overflow=e.css("overflow"),o.transform=e.css("transform"),o}function l(t,i,n,l,o,r,d){var c=e(".sticky-element-original").offset();if(orgElementTop=c.top,o){var a=e(o).offset();pushElementTop=a.top}var m=window,g="inner";"innerWidth"in window||(g="client",m=document.documentElement||document.body),viewport=m[g+"Width"],d&&e("body").hasClass("admin-bar")&&viewport>600?adminBarHeight=e("#wpadminbar").height():adminBarHeight=0,e(window).scrollTop()>=orgElementTop-t-adminBarHeight&&viewport>=i&&viewport<=n?(orgElement=e(".sticky-element-original"),coordsOrgElement=orgElement.offset(),leftOrgElement=coordsOrgElement.left,widthOrgElement=orgElement[0].getBoundingClientRect().width,widthOrgElement||(widthOrgElement=orgElement.css("width")),heightOrgElement=orgElement.outerHeight(),paddingOrgElement=[orgElement.css("padding-top"),orgElement.css("padding-right"),orgElement.css("padding-bottom"),orgElement.css("padding-left")],paddingCloned=paddingOrgElement[0]+" "+paddingOrgElement[1]+" "+paddingOrgElement[2]+" "+paddingOrgElement[3],1==r&&e(".sticky-element-cloned").length<1&&s(t,l),elementHeight=0,heightOrgElement<1?elementHeight=e(".sticky-element-cloned").outerHeight():elementHeight=e(".sticky-element-original").outerHeight(),o&&e(window).scrollTop()>pushElementTop-t-elementHeight-adminBarHeight?stickyTopMargin=pushElementTop-t-elementHeight-e(window).scrollTop():stickyTopMargin=adminBarHeight,e(".sticky-element-cloned").css("left",leftOrgElement+"px").css("top",t+"px").css("width",widthOrgElement).css("margin-top",stickyTopMargin).css("padding",paddingCloned).show(),e(".sticky-element-original").css("visibility","hidden")):(1==r?e(".sticky-element-cloned").remove():e(".sticky-element-cloned").hide(),e(".sticky-element-original").css("visibility","visible"))}function s(t,i){e(".sticky-element-original").clone().insertAfter(e(".sticky-element-original")).addClass("sticky-element-cloned").css("position","fixed").css("top",t+"px").css("margin-left","0").css("z-index",i).removeClass("sticky-element-original").hide()}e.fn.stickThis=function(o){var r=e.extend({top:0,minscreenwidth:0,maxscreenwidth:99999,zindex:1,legacymode:!1,dynamicmode:!1,debugmode:!1,pushup:"",adminbar:!1},o),d=e(this).length,c=e(r.pushup).length;return 1>c?(1==r.debugmode&&r.pushup&&console.error('STICKY ANYTHING DEBUG: There are no elements with the selector/class/ID you selected for the Push-up element ("'+r.pushup+'").'),r.pushup=""):c>1&&(1==r.debugmode&&console.error("STICKY ANYTHING DEBUG: There are "+c+' elements on the page with the selector/class/ID you selected for the push-up element ("'+r.pushup+'"). You can select only ONE element to push the sticky element up.'),r.pushup=""),1>d?1==r.debugmode&&console.error('STICKY ANYTHING DEBUG: There are no elements with the selector/class/ID you selected for the sticky element ("'+this.selector+'").'):d>1?1==r.debugmode&&console.error("STICKY ANYTHING DEBUG: There There are "+c+' elements with the selector/class/ID you selected for the sticky element ("'+this.selector+'"). You can only make ONE element sticky.'):1==r.legacymode?(e(this).addClass("sticky-element-original"),1!=r.dynamicmode&&s(r.top,r.zindex,r.adminbar),checkElement=setInterval(function(){l(r.top,r.minscreenwidth,r.maxscreenwidth,r.zindex,r.pushup,r.dynamicmode,r.adminbar)},10)):(e(this).addClass("sticky-element-original"),orgAssignedStyles=n(e(this)),orgInlineStyles=e(".sticky-element-original").attr("style"),null==orgInlineStyles&&(orgInlineStyles=""),i(),checkElement=setInterval(function(){t(r.top,r.minscreenwidth,r.maxscreenwidth,r.zindex,r.pushup,r.adminbar,orgAssignedStyles,orgInlineStyles)},10)),this}}(jQuery);