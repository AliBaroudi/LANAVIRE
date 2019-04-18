var images = new Array();
images.push("logo.png");
images.push("nussle.jpg");
images.push("dilasser.jpg");
images.push("logo.png");
images.push("nussle.jpg");
images.push("dilasser.jpg");
images.push("logo.png");
 
var pointeur = 0;
 
function ChangerImage(){
document.getElementById("masuperimage").src = images[pointeur];
 
if(pointeur < images.length - 1){
pointeur++;
}
else{
    pointeur=0;
}
 
window.setInterval("ChangerImage()", 2000)
}
 
// Charge la fonction
window.onload = function(){
ChangerImage();
}