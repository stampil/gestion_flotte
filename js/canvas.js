var ctx; // context du canvas, les methodes passeront par ça
var t; // interval de raffraichissement, peut etre killé par : clearInterval(t);
var refresh = 1 / 30; // 30 fps
var cursor = {x: 0, y: 0}; // défini un objet nommé cursor ayant 2 methode : x et y
var position = {x: 0, y: 0};
var TO_RADIANS = Math.PI / 180;
var angle = angle2 = angle3 = 0;

var bg = {w:1340,h:765};
var clicked = position;
var keyCode = null;
var ko_save;

$(window).load(function () { //permet de savoir que toute la page est chargé sur le client pour manipuler l'affichage

    //creation canvas avec taille dynamique ( sur chrome lancer la console ( F12, onglet console ) et ecrire  make_canvas({w:300,h:100}) par exemple
    make_canvas(bg);  //ds fonction.js

    //run program
    t = setInterval(function () { //doc javascript
        ctx.clearRect(0, 0, bg.w, bg.h); //efface le canvas entier toute les x seconde, principe du dessin animé qui défile
        //Affichage :
        //affiche_pos({x: 1, y: 22}); //ds fonction.js
        affiche_heure({x: 3, y: 13});

        for (i in symboles) {
            symboles[i].affiche();
        }

    }, refresh); //boucle toute les x secondes

    //event
    $('#canvas').mousemove(function (e) { // on rempli notre global cursor avec le e.offsetX de l'event mousemove a chaque fois que la page detect un mouvmt souris dans le canvas
        cursor.x = e.offsetX;
        cursor.y = e.offsetY;
    });

    $('#canvas').click(function (e) {
        clicked.x = e.offsetX;
        clicked.y = e.offsetY;
    });

    $('body').keydown(function (e) {
        /*
         * e.altKey :true|false
         * e.ctrlKey
         * e.shiftKey
         * e.keyCode
         */
        keyCode = e.keyCode;
        console.log(keyCode);
        if(keyCode==83){
            save_symbole();
           
        }
    });

    $('body').keyup(function () {
        keyCode = '';
    });
});


