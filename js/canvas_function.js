function make_canvas(bg) {
    //$('#canvas').width(width); bug : blurry
    document.getElementById('canvas').width = bg.w;
    document.getElementById('canvas').height = bg.h;
    ctx = $('#canvas').get(0).getContext('2d'); // issue de la doc canvas
    ctx.fillStyle = 'black';
    $('#canvas').css("background", "url('images/space_map_grid_only.png')");

}

function affiche_pos(p) {
    // p la position où on l'affiche sur le canvas
    //cursor : la globale calculé avec l'evenement on mouse over
    ctx.fillText('(' + cursor.x + ',' + cursor.y + ')', p.x, p.y); // doc canvas : ctx.fillText( text, x, y )
}

function affiche_position(p) {
    // p la position où on l'affiche sur le canvas
    //cursor : la globale calculé avec l'evenement on mouse over
    ctx.fillText('(' + position.x + ',' + position.y + ')', p.x, p.y); // doc canvas : ctx.fillText( text, x, y )
}

function affiche_direction(p) {
    ctx.fillText(direction, p.x, p.y); // doc canvas : ctx.fillText( text, x, y )
}

function affiche_heure(p) {
    // p la position où on l'affiche sur le canvas
    var d = new Date();
    ctx.fillText(d.getHours() + ':' + (d.getMinutes() < 10 ? '0' + d.getMinutes() : d.getMinutes()) + ':' + (d.getSeconds() < 10 ? '0' + d.getSeconds() : d.getSeconds()), p.x, p.y);
}

function give_me_a_color() {
    return '#' + Math.random().toString(16).substr(2, 6);
}

/*
 * exemple : drawRotatedImage(img_hourglass, {x:27,y:51}, ++angle3%360);  ou --angle3%360
 */
function drawRotatedImage(image, p, angle) {
    // save the current co-ordinate system 
    // before we screw with it
    ctx.save();
    // move to the middle of where we want to draw our image
    ctx.translate(p.x, p.y);
    // rotate around that point, converting our 
    // angle from degrees to radians 
    ctx.rotate(angle * TO_RADIANS);
    // draw it up and to the left by half the width
    // and height of the image 
    ctx.drawImage(image, -(image.width / 2), -(image.height / 2));
    // and restore the co-ords to how they were when we began
    ctx.restore();
}

function save_symbole(){
    ko_save = false;
    for (i in symboles) {
            symboles[i].save();
        }
        setTimeout(function(){
        if(!ko_save){
            alert('formation enregistrée');
        }
        else{
            alert('Vous devez etre l\'organisateur pour sauvegarder la formation, ou vous reconnectez si vous l\'etes.');
       }
        }
    ,2000);
}

function Symbole(pos, symbole, color, type, num, nomVaiss, nomJoueur, id_joueur, id_sortie, force_vip) {
    this.color = '';
    this.indice_couleur = color;
    this.symbole = symbole; // type_symbole.leger ...
    this.posOrigin = pos;
    this.pos = pos;
    this.type = type; //type_vaisseau.medical...
    this.typeOrigin = type;
    this.num = num; //position escadrille
    this.nomVaiss = nomVaiss;
    this.nomJoueur = nomJoueur;
    this.mouvement = false;
    this.clicked = false;
    this.clickedForced = false;
    this.id_joueur = id_joueur;
    this.id_sortie = id_sortie;
    this.force_vip = force_vip;

    this.colorise = function () {
        this.color = couleurs[this.indice_couleur];
        if(this.force_vip){
            this.type= type_vaisseau.VIP;
            this.force_vip = false; // permet de remodifier
        }
    }

    this.save = function(){
        var vip = false;
        if(this.type != this.typeOrigin && this.type==type_vaisseau.VIP){
            vip=true;
        }
        $.post( "ajax/save_formation.php", {
            "id_joueur":this.id_joueur,
            "id_sortie":this.id_sortie,
            "x":this.pos.x,
            "y":this.pos.y,
            "couleur":this.indice_couleur,
            "num":this.num,
            "is_vip":vip
        }, function( data ) {
          if(data){ko_save=true};
        });
        
    }
    this.affiche = function () {
        this.colorise();
        
        if(this.num == 1) this.num ='L';
        ctx.save();
        ctx.strokeStyle = '#202124';
        ctx.lineWidth = "3";
        switch (this.symbole) {
            case type_symbole.leger:
                ctx.beginPath();
                ctx.moveTo(this.pos.x, this.pos.y);
                ctx.lineTo(this.pos.x + 60, this.pos.y);
                ctx.lineTo(this.pos.x + 60, this.pos.y - 35);
                ctx.lineTo(this.pos.x + 30, this.pos.y - 45);
                ctx.lineTo(this.pos.x, this.pos.y - 35);
                ctx.closePath();
                ctx.lineJoin = 'round';
                if (ctx.isPointInPath(clicked.x, clicked.y) || this.clickedForced) {
                    this.clicked = true;
                    ctx.lineWidth = "6";
                }
                else {
                    this.clicked = false;
                    ctx.lineWidth = "3";
                }
                ctx.stroke();
                ctx.fillStyle = this.color;
                ctx.shadowColor = '#999';
                ctx.shadowBlur = 10;
                ctx.shadowOffsetX = 5;
                ctx.shadowOffsetY = 5;
                ctx.fill();

                //ctx.fillText(this.clicked, this.pos.x, this.pos.y + 34);
                ctx.lineWidth = "2";
                switch (this.type) {
                    case type_vaisseau.medical:
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 30, this.pos.y - 45);
                        ctx.lineTo(this.pos.x + 30, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x, this.pos.y - 20);
                        ctx.lineTo(this.pos.x + 60, this.pos.y - 20);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 20, this.pos.y - 34);
                        break;
                    case type_vaisseau.VIP:
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x, this.pos.y - 25);
                        ctx.lineTo(this.pos.x + 30, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 60, this.pos.y - 25);
                        ctx.lineTo(this.pos.x + 30, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 27, this.pos.y - 34);
                        break;
                    case type_vaisseau.combat :
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x, this.pos.y - 35);
                        ctx.lineTo(this.pos.x + 60, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 60, this.pos.y - 35);
                        ctx.lineTo(this.pos.x, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 27, this.pos.y - 34);
                        break;
                    case type_vaisseau.marchand :

                        ctx.beginPath();
                        ctx.rect(this.pos.x + 10, this.pos.y - 25, 40, 20);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 27, this.pos.y - 34);

                        break;
                    default:
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 27, this.pos.y - 34);
                        break;
                }

                ctx.fillStyle = 'black';
                ctx.fillText(this.nomVaiss, this.pos.x, this.pos.y + 10);
                ctx.fillText(this.nomJoueur, this.pos.x, this.pos.y + 20);
                break;
            case type_symbole.moyen:
                ctx.beginPath();
                ctx.moveTo(this.pos.x, this.pos.y);
                ctx.lineTo(this.pos.x + 70, this.pos.y);
                ctx.lineTo(this.pos.x + 90, this.pos.y - 55);
                ctx.lineTo(this.pos.x + 35, this.pos.y - 95);
                ctx.lineTo(this.pos.x - 20, this.pos.y - 55);
                ctx.closePath();
                ctx.lineJoin = 'round';
                if (ctx.isPointInPath(clicked.x, clicked.y) || this.clickedForced) {
                    this.clicked = true;
                    ctx.lineWidth = "6";
                }
                else {
                    this.clicked = false;
                    ctx.lineWidth = "3";
                }
                ctx.stroke();
                ctx.fillStyle = this.color;
                ctx.shadowColor = '#999';
                ctx.shadowBlur = 10;
                ctx.shadowOffsetX = 5;
                ctx.shadowOffsetY = 5;
                ctx.fill();
                ctx.lineWidth = "2";
                switch (this.type) {

                    case type_vaisseau.medical:
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 35, this.pos.y - 95);
                        ctx.lineTo(this.pos.x + 35, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x - 15, this.pos.y - 40);
                        ctx.lineTo(this.pos.x + 86, this.pos.y - 40);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 20, this.pos.y - 64);
                        break;
                    case type_vaisseau.VIP:
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x - 20, this.pos.y - 55);
                        ctx.lineTo(this.pos.x + 35, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 90, this.pos.y - 55);
                        ctx.lineTo(this.pos.x + 35, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 31, this.pos.y - 64);
                        break;
                    case type_vaisseau.combat :
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x - 20, this.pos.y - 55);
                        ctx.lineTo(this.pos.x + 70, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 90, this.pos.y - 55);
                        ctx.lineTo(this.pos.x, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 31, this.pos.y - 64);
                        break;
                    case type_vaisseau.marchand :
                        ctx.beginPath();
                        ctx.rect(this.pos.x + 10, this.pos.y - 45, 50, 30);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 31, this.pos.y - 64);
                        break;
                    default:
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 31, this.pos.y - 64);
                        break;
                }
                ctx.fillStyle = 'black';
                ctx.fillText(this.nomVaiss, this.pos.x, this.pos.y + 10);
                ctx.fillText(this.nomJoueur, this.pos.x, this.pos.y + 20);
                break;
            case type_symbole.lourd:
                ctx.beginPath();
                ctx.moveTo(this.pos.x, this.pos.y);
                ctx.lineTo(this.pos.x + 160, this.pos.y);
                ctx.lineTo(this.pos.x + 160, this.pos.y - 145);
                ctx.lineTo(this.pos.x + 155, this.pos.y - 155);
                ctx.lineTo(this.pos.x + 5, this.pos.y - 155);
                ctx.lineTo(this.pos.x, this.pos.y - 145);
                ctx.closePath();
                ctx.lineJoin = 'round';
                if (ctx.isPointInPath(clicked.x, clicked.y) || this.clickedForced) {
                    this.clicked = true;
                    ctx.lineWidth = "6";                    
                }
                else {
                    this.clicked = false;
                    ctx.lineWidth = "3";
                }
                ctx.stroke();
                ctx.fillStyle = this.color;
                ctx.shadowColor = '#999';
                ctx.shadowBlur = 10;
                ctx.shadowOffsetX = 5;
                ctx.shadowOffsetY = 5;
                ctx.fill();
                ctx.lineWidth = "2";
                switch (this.type) {

                    case type_vaisseau.medical:
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 80, this.pos.y - 155);
                        ctx.lineTo(this.pos.x + 80, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x, this.pos.y - 76);
                        ctx.lineTo(this.pos.x + 160, this.pos.y - 76);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 60, this.pos.y - 134);
                        break;
                    case type_vaisseau.VIP:
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x, this.pos.y - 85);
                        ctx.lineTo(this.pos.x + 80, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 160, this.pos.y - 85);
                        ctx.lineTo(this.pos.x + 80, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 75, this.pos.y - 134);
                        break;
                    case type_vaisseau.combat :
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x, this.pos.y - 85);
                        ctx.lineTo(this.pos.x + 160, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.beginPath();
                        ctx.moveTo(this.pos.x + 160, this.pos.y - 85);
                        ctx.lineTo(this.pos.x, this.pos.y);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 75, this.pos.y - 134);
                        break;
                    case type_vaisseau.marchand :
                        ctx.beginPath();
                        ctx.rect(this.pos.x + 15, this.pos.y - 115, 130, 100);
                        ctx.closePath();
                        ctx.stroke();
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 75, this.pos.y - 134);
                        break;
                    default:
                        ctx.fillStyle = 'black';
                        ctx.fillText(this.num, this.pos.x + 75, this.pos.y - 134);
                        break;
                }
                ctx.fillStyle = 'black';
                ctx.fillText(this.nomVaiss, this.pos.x, this.pos.y + 10);
                ctx.fillText(this.nomJoueur, this.pos.x, this.pos.y + 20);

                break;
            default:
                break;
        }
        ctx.lineWidth = "1";

        if (this.clicked) {
            switch (keyCode) {
                case 67://c couleur
                case 38://fleche haut
                case 40://fleche bas
                    this.indice_couleur = ++this.indice_couleur % couleurs.length;
                    break;
                case 97:
                case 49:
                case 76:
                    this.num = 'L';
                    break;
                case 98:
                case 50:
                    this.num = 2;
                    break;
                case 99:
                case 51:
                    this.num = 3;
                    break;
                case 100:
                case 52:
                    this.num = 4;
                    break;
                case 86: //v VIP
                    if (this.typeOrigin != this.type) {
                        this.type = this.typeOrigin;
                    }
                    else {
                        this.type = type_vaisseau.VIP;
                    }
                    break;
                case 68: //d defaut
                case 78: //n neutre
                    this.type = this.typeOrigin;
                    break;
                case 77: //m mouvement
                    if (!this.clickedForced) {
                        this.pos = cursor;
                        this.clickedForced = true;
                    }
                    else {
                        this.pos = {x: cursor.x, y: cursor.y};
                        this.clickedForced = false;
                        console.log(cursor);
                    }
                    break;
                case 70: //f fixe
                    this.pos = {x: cursor.x, y: cursor.y};
                    this.clickedForced = false;
                    console.log(cursor);
                    break;
            }
            fonction = '';
            keyCode = null;      
        }
        ctx.restore();
    }
}