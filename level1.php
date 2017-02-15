<!DOCTYPE html>
<HTML>
<HEAD>
    <META content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <LINK href="style.css" rel="stylesheet" type="text/css" />
    <TITLE>Gamepjuh</TITLE>
</HEAD>
<style>
    #gamecanvas {
        border: 1px solid black;
        position: absolute;
        left: 25%;
        top: 40%;
        background: url("web_img/background_small.png");
        background-size: cover;
        background-position: 0px 0px;
        background-repeat: repeat-x;

        animation: animatedBackground 200000s linear infinite;
        -webkit-animation: animatedBackground 200000s linear infinite;
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
        var myGrass = [];

        var Obstacle1;
        var Obstacle2;

        var audio = new Audio('theme.mp3');
        var jumpaudio = new Audio('jump.mp3')


        function startGame() {
            // myGamePiece = new component(30, 30, "red", 60, 120, "", "sprites/sprite.png");
            myGamePiece = new component(30, 30, "transparent", 10, 120);
            myGamePiece.gravity = 0.05;
            myScore = new component("30px", "Consolas", "black", 480, 40, "text");
            // Obstacle1  = new component(50, 25, "green", 200, 245);
            // Obstacle2  = new component(50, 25, "green", 300, 230);
            myGrass = new component(20, 20, "transparent", 10, 120, "object2");
            myGameArea.start();
            audio.volume = 0.2;
            audio.play();
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
                    jumpaudio.play();
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

         // ************
            // sprites
        // ************

        var imageRepository = new function() {
            //define images
            this.player = new Image();
            this.block_deadly = new Image();
            this.grass = new Image();

            //Ensure all images have been loaded before game start
            var numImages = 3;
            var numLoaded = 0;
            function imageLoaded() {
                numLoaded++
                if (numLoaded === numImages) {
                    window.init;
                } else {
                    alert("images not loaded");
                }
            }
            this.player.onload = function () {
                imageLoaded();
            }
            this.block_deadly.onLoad = function () {
                imageLoaded();
            }
            this.grass.onLoad = function () {
                imageLoaded();
            }

            //Set image src
            this.player.src = "sprites/sprite.png";
            this.block_deadly.src = "sprites/spike.png";
            this.grass.src = "sprites/grass.png";

        };

        function component(width, height, color, x, y, type, image) {
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
                }else {
                    if (this.type == "object") {
                        ctx.save
                        ctx.drawImage(imageRepository.block_deadly, this.x, this.y, this.width, this.height);
                        ctx.restore
                        ctx.fillStyle = color;
                        ctx.fillRect(this.x, this.y, this.width, this.height);
                    }else {
                        ctx.save
                        ctx.drawImage(imageRepository.player, this.x, this.y, this.width, this.height);
                        ctx.restore
                    }if (this.type == "object2") {
                        ctx.save
                        ctx.drawImage(imageRepository.grass, this.x, this.y, this.width, this.height);
                        ctx.restore
                    }
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
                var crash = false;

                var outsideothertop = othertop - 2;
                var outsideotherbottom = otherbottom + 2;
                var insideotherleft = otherleft  + 2;
                var insideotherright = otherright + 2;

                if(((mybottom > outsideothertop) && (mybottom < otherbottom)) && ((myleft > insideotherleft) && (myleft < insideotherright)) ||
                    ((mybottom > outsideothertop) && (mybottom < otherbottom)) && ((myright > insideotherleft) && (myright < insideotherright))) {
                    mybottom = outsideothertop;
                    this.gravitySpeed = -0.1;
                }

                if(((mytop > othertop) && (mytop < outsideotherbottom)) && ((myleft > insideotherleft) && (myleft < insideotherright)) ||
                    ((mytop > othertop) && (mytop < outsideotherbottom)) && ((myright > insideotherleft) && (myright < insideotherright))) {
                    mytop = outsideotherbottom;
                    this.gravitySpeed = 1;
                    this.gravity = 0;
                }

                if(((mybottom >othertop) && (mybottom < otherbottom)) && ((myleft > otherleft) && (myleft < otherright)) ||
                    ((mybottom >othertop) && (mybottom < otherbottom)) && ((myright > otherleft) && (myright < otherright)) ||
                    ((mytop > othertop) && (mytop < otherbottom)) && ((myleft > otherleft) && (myleft < otherright)) ||
                    ((mytop > othertop) && (mytop < otherbottom)) && ((myright > otherleft) && (myright < otherright))) {
                    crash = true;
                }


                return crash;
            }
        }

        function updateGameArea() {
            var x, height, gap, minHeight, maxHeight, minGap, maxGap;
//        to stop the block
            for (i = 0; i < myObstacles.length; i += 1) {
                if (myGamePiece.crashWith(myObstacles[i])) {
                    alert("Game over");
                    alert("Your score:" + myGameArea.frameNo);
                    document.write("<form action='gameover.php method='POST'>");
                    document.write("<p class='score'>Score" + myGameArea.frameNo + "</p>");
                    document.write("<input type='button' name='submit' value='verzend score'>")
                    document.write("</form>");
                    window.location = "gameover.php";
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

//              Push new objects into game, specifying height, width and cords. User height or gap for random cords
                myObstacles.push(new component(20, 20, "transparent", x, 250, "object"));
                myGrass.push(new component(10, 10, "black", x, 200, "object"));
            }

            // Note to self (stijn) Add for loop for extra objects w / w/o collision
                //do not touch plz
            for (i = 0; i < myObstacles.length; i += 1) {
                myObstacles[i].x += -1;
                myObstacles[i].update();
            }
            for (i = 0; i < myGrass.length; i += 1) {
                myGrass[i].x += -1;
                myGrass[i].update();
            }

            if (myGameArea.key && myGameArea.key == 32) {
                jump();
            }
            myScore.text="SCORE: " + myGameArea.frameNo;
            myScore.update();
            myGamePiece.newPos();
            myGamePiece.update();
        }

        function drawPlayer() {
            ctx.save
            ctx.drawImage(player, this.x, this.y);
            ctx.restore
        }

        function drawBlock_deadly() {
            ctx.save
            ctx.drawImage(block_deadly, this.x, this.y);
            ctx.restore
        }

        function drawGrass() {
            ctx.save
            ctx.drawImage(grass, this.x, this.y);
            ctx.restore
        }

        function everyinterval(n) {
            if((myGameArea.frameNo / n) % 1 == 0) {return true;}
            return false;
        }

        function accelerate() {
            myGamePiece.gravity = 0.2;
        }

        function jump() {
            if(myGamePiece.y > 120) {
                if(myGamePiece.gravitySpeed < 1) {
                    myGamePiece.gravitySpeed = -4;
                    setTimeout(accelerate, 200);
                }
            }
        }

    </script>
</div>




</BODY>
</HTML>