/*function ResizeFrame(name)
{
  // IFRAME 내부의 body 개체
  var fBody  = document.frames(name).document.body;
  // IFRAME 개체
  var fName  = document.all(name);

  // IFRAME 내부의 body개체의 넓이를 계산하여 IFRAME의 넓이를 설정해 준다.
  fName.style.width 
    = fBody.scrollWidth + (fBody.offsetWidth - fBody.clientWidth);
  // IFRAME 내부의 body개체의 높이를 계산하여 IFRAME의 높이를 설정해 준다.
  fName.style.height 
    = fBody.scrollHeight + (fBody.offsetHeight - fBody.clientHeight);

  // 만약 IFRAME의 크기 설정에 실패 하였다면 기본크기로 설정한다.
  if (Frame_name.style.height == "0px" || Frame_name.style.width == "0px")
  {
    fName.style.width = "700px";     //기본 iframe 너비
    fName.style.height = "300px";    //기본 iframe 높이
  }
}
*/

function resizeIframe(fr) { 
fr.setExpression('height',ifrm.document.body.scrollHeight); 
fr.setExpression('width',ifrm.document.body.scrollWidth); 
} 
/*
function autoResize(i)
{
   var iframeHeight=
   (i).contentWindow.document.body.scrollHeight;
 (i).height=iframeHeight+20;
}*/