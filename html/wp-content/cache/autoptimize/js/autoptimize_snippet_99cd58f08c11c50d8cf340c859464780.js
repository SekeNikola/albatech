!function(e){"use strict";jQuery(document).ready(function(e){function t(e){var e=window,t="inner";"innerWidth"in window||(t="client",e=document.documentElement||document.body),c=e[t+"Width"]}function i(){E=p.offsetHeight,parseInt(e(p).css("marginBottom"))>0&&(w.style.marginBottom=e(p).css("marginBottom")),"0"==E&&e(p).children().filter(":visible").each(function(){E=e(this).outerHeight(!0)})}function o(){p.classList.add("myfixed"),C=e(".myfixed").outerHeight(),"0"==C&&e(".myfixed").children().filter(":visible").each(function(){C=e(this).outerHeight(!0)}),p.classList.remove("myfixed")}function s(){B="true"==u&&c>600&&e("#wpadminbar")[0]?e("#wpadminbar").height():0,"on"==m?k.style.top="-"+C+"px":k.style.top=B+"px"}function n(){var t=e(p)[0].getBoundingClientRect();S=t.width}function d(){1==b&&("on"==m&&(y=e(p).offset().top+E-B,H=e(p).offset().top+E-B,"on"==v&&(H=e(p).offset().top-B)),"fade"==m&&("false"==v&&(y=e(p).offset().top-B,H=e(p).offset().top-B),"on"==v&&(y=e(p).offset().top-B+E,H=e(p).offset().top-B)))}function a(){1==b&&E>C&&("on"==m?(H=y,"on"==v&&(H=y-C)):(y=E,H=E))}function r(e){if(c>=f){var t=N?window.scrollY:document.documentElement.scrollTop;if(t>=0){if(t>=I)t>=y?p.classList.add("myfixed"):"",t>=y?k.classList.add("wrapfixed"):"",t>=y?w.style.height=E+"px":"",t>=y?p.style.width=S+"px":"","on"==m&&("false"==v&&(t>=y+C-B?k.style.top=B+"px":k.style.top="-"+C+"px"),E>C&&"false"==v&&(y+C>t?k.style.top="-"+E+"px":"",t>=y+C?k.style.top=B+"px":"")),k.classList.add("down"),k.classList.remove("up"),"on"==v&&(k.style.top="-"+(E+B)+"px");else{var i=N?window.scrollY:document.documentElement.scrollTop;i>H?"":w.style.height="",i>H?"":p.style.width="","on"==m?(i>H?"":p.classList.remove("myfixed"),i>H?"":k.classList.remove("wrapfixed"),"false"==v&&(H+C+200-B>i?k.style.top="-"+C+"px":"")):(i>H?"":p.classList.remove("myfixed"),i>H?"":k.classList.remove("wrapfixed")),k.classList.remove("down"),k.classList.add("up"),"on"==v&&(k.style.top=B+"px")}I=t}else k.classList.remove("up")}}function l(){e(window).width()!=T&&(k.classList.remove("up"),k.classList.remove("down"),e(".wrapfixed")[0]?(p.classList.remove("myfixed"),k.classList.remove("wrapfixed")):(i(),p.style.removeProperty("width"),n()),t(),s(),o(),d(),a())}if(e(option.mystickyClass)[0]){var c,p=document.querySelector(option.mystickyClass),f=parseInt(option.disableWidth),m=option.mystickyTransition,y=parseInt(option.activationHeight),u=option.adminBar,v=option.mysticky_disable_down;t();for(var h=p.parentNode,w=document.createElement("div"),x=0,L=0;L<h.childNodes.length;L++)if(h.childNodes[L]==p){x=L;break}w.id="mysticky-wrap",w.appendChild(p),h.insertBefore(w,h.childNodes[x]);var g=p.parentNode,k=document.createElement("div");if(k.id="mysticky-nav",g.replaceChild(k,p),k.appendChild(p),"0"==y)var b=!0;var E;i();var C;o();var B=0;s();var S;n();var H=y;d(),a();var N="scrollY"in window,I=0;document.addEventListener("scroll",r);var T=e(window).width();window.addEventListener("resize",l),window.addEventListener("orientationchange",l)}else console.log("myStickymenu: Entered Sticky Class does not exist, change it in Dashboard / Settings / myStickymenu / Sticky Class. ")})}(jQuery);