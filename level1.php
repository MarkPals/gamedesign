<!DOCTYPE html>
<HTML>
<HEAD>
    <META content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <LINK href="style.css" rel="stylesheet" type="text/css" />
    <TITLE>Gamepjuh</TITLE>
</HEAD>
<style>
    #canvas, #gamecanvas {
        border: 1px solid black;
        position: absolute;
        left: 25%;
        top: 40%;
        background: url("web_img/background_small.png");
        background-size: cover;
        background-position: 0px 0px;
        background-repeat: repeat-x;

        animation: animatedBackground 200000s linear infinite;
    }

    /*#canvas {*/
        /*z-index: 999;*/
    /*}*/

    /*#gamecanvas {*/
        /*z-index: 1;*/
    /*}*/
</style>
<BODY onload="startGame()">

<h1>Gamepjuh</h1>
<p class="controls">Press space to jump</p>
<div id="test">
    <canvas id="gamecanvas"></canvas>


    <script>

        var myGamePiece;
        var myObstacles = [];
        var myScore;

        var Obstacle1;
        var Obstacle2;


        function startGame() {
            myGamePiece = new component(30, 30, "red", 60, 120, "", "sprites/sprite.png");
            myGamePiece.gravity = 0.05;
            myScore = new component("30px", "Consolas", "black", 480, 40, "text");
            Obstacle1  = new component(50, 25, "green", 200, 245);
            Obstacle2  = new component(50, 25, "green", 300, 230);
            myGameArea.start();
        }

        var myGameArea = {
            canvas : document.getElementById("gamecanvas"),
            start : function() {
                this.canvas.width = 680;
                this.canvas.height = 270;
                this.context = this.canvas.getContext("2d");
                document.body.insertBefore(this.canvas, document.body.childNodes[0]);
                this.frameNo = 0;
                window.addEventListener('keydown', function (e) {
                    myGameArea.key = e.keyCode;
                    press++;
                })
                window.addEventListener('keyup', function (e) {
                    myGameArea.key = false;
                })
                this.interval = setInterval(updateGameArea, 5.5);
            },
            clear : function() {
                this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
            }
        }

        function component(width, height, color, x, y, type, image) {
            this.image = image;
            this.type = type;
            this.score = 0;
            this.width = width;
            this.height = height;
            this.speedX = 0;
            this.speedY = 0;
            this.x = x;
            this.y = y;
            this.gravity = 0;
            this.gravitySpeed = 0;
            this.update = function() {
                ctx = myGameArea.context;
                if (this.type == "text") {
                    ctx.font = this.width + " " + this.height;
                    ctx.fillStyle = color;
                    ctx.fillText(this.text, this.x, this.y);
                } else {
                    ctx.fillStyle = color;
                    myGamePiece.background = this.image;
                    ctx.fillRect(this.x, this.y, this.width, this.height);
                }
            }
            this.newPos = function() {
                this.gravitySpeed += this.gravity;
                this.x += this.speedX;
                this.y += this.speedY + this.gravitySpeed;
                this.hitBottom();
            }
            this.hitBottom = function() {
                var rockbottom = myGameArea.canvas.height - this.height;
                if (this.y > rockbottom) {
                    this.y = rockbottom;
                    this.gravitySpeed = 0;
                }
            }
            this.crashWith = function(otherobj) {
                var myleft = this.x;
                var myright = this.x + (this.width);
                var mytop = this.y;
                var mybottom = this.y + (this.height);
                var otherleft = otherobj.x;
                var otherright = otherobj.x + (otherobj.width);
                var othertop = otherobj.y;
                var otherbottom = otherobj.y + (otherobj.height);
                var crash = true;
                if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
                    crash = false;
                }
                return crash;
            }
        }

        function updateGameArea() {
            var x, height, gap, minHeight, maxHeight, minGap, maxGap;
//        to stop the block
            for (i = 0; i < myObstacles.length; i += 1) {
                if (myGamePiece.crashWith(myObstacles[i])) {
                    return;
                }
            }
            myGameArea.clear();
            myGameArea.frameNo += 1;
            if (myGameArea.frameNo == 1 || everyinterval(150)) {
                x = myGameArea.canvas.width;
                minHeight = 20;
                maxHeight = 200;
                height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
                minGap = 50;
                maxGap = 200;
                gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
//                Obstacle1.push(new component(10, height, "green", x, 0));
//                Obstacle1.push(new component(10, x - height - gap, "green", x, height + gap));
//                Obstacle2.update();
//                myObstacles.push(new component(20, 20, "green", x, height - gap));
                myObstacles.push(new component(20, 20, "red", x, 250));
            }
            for (i = 0; i < myObstacles.length; i += 1) {
                myObstacles[i].x += -1;
                myObstacles[i].update();
            }

            if (myGameArea.key && myGameArea.key == 32) {
                jump();
            }
            myScore.text="SCORE: " + myGameArea.frameNo;
            myScore.update();
            myGamePiece.newPos();
            myGamePiece.update();
        }

        function everyinterval(n) {
            if((myGameArea.frameNo / n) % 1 == 0) {return true;}
            return false;
        }

        function accelerate() {
            myGamePiece.gravity = 0.2;
        }

        function jump() {
            if(myGamePiece.y > 150) {
                myGamePiece.gravity = -0.1;
                setTimeout(accelerate, 100);
            }
        }

//        var canvas = document.getElementById("canvas");
//        var ctx = canvas.getContext("2d");
//        canvas.width = 680;
//        canvas.height = 270;
//
//        //draw Image
//        var velocity=100;
//        var bgImage = new Image();
//        bgImage.addEventListener('load',drawImage,false);
//        bgImage.src = "sprites/hoi.jpg";
//        function drawImage(time){
//            var framegap=time-lastRepaintTime;
//            lastRepaintTime=time;
//            var translateX=velocity*(framegap/1000);
//            ctx.clearRect(0,0,canvas.width,canvas.height);
//            var pattern=ctx.createPattern(bgImage,"repeat-x");
//            ctx.fillStyle=pattern;
//            ctx.rect(translateX,0,bgImage.width,bgImage.height);
//            ctx.fill();
//            ctx.translate(-translateX,0);
//            requestAnimationFrame(drawImage);
//        }
//        var lastRepaintTime=window.performance.now();
    </script>
</div>




</BODY>
</HTML>