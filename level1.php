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

</style>
<BODY onload="startGame()">

<h1>Gamepjuh</h1>
<p class="controls">Press space to jump</p>
<div id="test">
    <canvas id="gamecanvas"></canvas>
    <?php
        echo "<script>var naamPlayer = '" . $_POST["naam"] . "';</script><br>";
    ?>

    <script>

        var myGamePiece;
        var myObstacles = [];
        var myObstaclesplatform = [];
        var myScore;
        var dead = false;

        function startGame() {

            myGamePiece = new component(30, 30, "transparent", 10, 120, "player");
            myGamePiece.gravity = 0.2;
            myScore = new component("30px", "Consolas", "black", 480, 40, "text");
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
                });
                window.addEventListener('keyup', function () {
                    myGameArea.key = false;
                });
                this.interval = setInterval(updateGameArea, 5.5);
            },
            clear : function() {
                this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
            }
        };

        // ************
        // sprites
        // ************

        var imageRepository = new function() {
            //define images
            this.player = new Image("kaas");
            this.block = new Image();
            this.spike = new Image();

            //Ensure all images have been loaded before game start
            var numImages = 2;
            var numLoaded = 0;
            function imageLoaded() {
                numLoaded++;
                if (numLoaded === numImages) {
                    window.init;
                } else {
//                    alert("images not loaded");
                }
            }
            this.player.onload = function () {
                imageLoaded();
            };
            this.block.onLoad = function () {
                imageLoaded();
            };

            this.spike.onload = function () {
                imageLoaded();
            }

            //Set image src
            this.player.src = "sprites/sprite.png";
            this.block.src = "sprites/rock.png";
            this.spike.src = "sprites/spike.png";

        };

        function component(width, height, color, x, y, type) {
            this.type = type;
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
                    if (this.type == "object" || this.type == "objectplatform") {
                        ctx.save
                        ctx.drawImage(imageRepository.block, this.x, this.y, this.width, this.height);
                        ctx.restore
                        // ctx.fillRect(this.x, this.y, this.width, this.height);
                    }
                    if(this.type == "player") {
                        ctx.save;
                        ctx.drawImage(imageRepository.player, this.x, this.y, this.width, this.height);
                        ctx.restore;
                    }
                    if (this.type == "objectspike") {
                        ctx.save;
                        ctx.drawImage(imageRepository.spike, this.x, this.y, this.width, this.height);
                        ctx.restore;
                    }

                }
            };
            this.newPos = function() {
                this.gravitySpeed += this.gravity;
                this.x += this.speedX;
                this.y += this.speedY + this.gravitySpeed;
                this.hitBottom();
            };
            this.hitBottom = function() {
                var rockbottom = myGameArea.canvas.height - this.height;
                if (this.y > rockbottom) {
                    this.y = rockbottom;
                    this.gravitySpeed = 0;
                }
            };
            this.crashWithplatform = function(otherobj) {
                var myleft = this.x;
                var myright = this.x + (this.width);
                var mytop = this.y;
                var mybottom = this.y + (this.height);
                var otherleft = otherobj.x;
                var otherright = otherobj.x + (otherobj.width);
                var othertop = otherobj.y;
                var otherbottom = otherobj.y + (otherobj.height);
                var type = otherobj.type;
                var crash = false;

                var outsideothertop = othertop - 2;
                var outsideotherbottom = otherbottom + 2;
                var insideotherleft = otherleft  + 2;
                var insideotherright = otherright + 2;

                if (((mybottom > outsideothertop) && (mybottom < otherbottom)) && ((myleft > insideotherleft) && (myleft < insideotherright)) ||
                    ((mybottom > outsideothertop) && (mybottom < otherbottom)) && ((myright > insideotherleft) && (myright < insideotherright))) {
                    mybottom = outsideothertop;
                    this.gravitySpeed = -0.1;
                }

                if (((mytop > othertop) && (mytop < outsideotherbottom)) && ((myleft > insideotherleft) && (myleft < insideotherright)) ||
                    ((mytop > othertop) && (mytop < outsideotherbottom)) && ((myright > insideotherleft) && (myright < insideotherright))) {
                    mytop = outsideotherbottom;
                    this.gravitySpeed = 1;
                    this.gravity = 0;
                }


                if (((mybottom > othertop) && (mybottom < otherbottom)) && ((myleft > otherleft) && (myleft < otherright)) ||
                    ((mybottom > othertop) && (mybottom < otherbottom)) && ((myright > otherleft) && (myright < otherright)) ||
                    ((mytop > othertop) && (mytop < otherbottom)) && ((myleft > otherleft) && (myleft < otherright)) ||
                    ((mytop > othertop) && (mytop < otherbottom)) && ((myright > otherleft) && (myright < otherright))) {
                    crash = true;
                    dead = true;
                }

                return crash;
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

                if (((mybottom > othertop) && (mybottom < otherbottom)) && ((myleft > otherleft) && (myleft < otherright)) ||
                    ((mybottom > othertop) && (mybottom < otherbottom)) && ((myright > otherleft) && (myright < otherright)) ||
                    ((mytop > othertop) && (mytop < otherbottom)) && ((myleft > otherleft) && (myleft < otherright)) ||
                    ((mytop > othertop) && (mytop < otherbottom)) && ((myright > otherleft) && (myright < otherright))) {
                    crash = true;
                    dead = true;
                    
                }

                return crash;
            }
        }

        function updateGameArea() {
            var x, height, gap, minHeight, maxHeight, minGap, maxGap;
//        to stop the block
            for (i = 0; i < myObstacles.length; i += 1) {
                if (myGamePiece.crashWith(myObstacles[i])) {
                    var testid = makeid() + myGameArea.frameNo + 1340 + makeid();
                    
                    window.location.href = "gameover.php?score=" + testid + "&naam=" + naamPlayer;               
                    break;
                }
            }


            for (i = 0; i < myObstaclesplatform.length; i += 1) {
                if (myGamePiece.crashWithplatform(myObstaclesplatform[i])) {
                    var testid = makeid() + myGameArea.frameNo + 1340 + makeid();
                    
                    window.location.href = "gameover.php?score=" + testid + "&naam=" + naamPlayer;   
                    break;
                }
            }
            if (dead) { //while

            }
            myGameArea.clear();
            myGameArea.frameNo += 1;

            if (myGameArea.frameNo == 1 || everyinterval(150)) {
                x = myGameArea.canvas.width;
                minHeight = 150;
                maxHeight = 220;
                height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
                myObstaclesplatform.push(new component(60, 30, "blue", x, height, "objectplatform"));
            }

            if (myGameArea.frameNo == 1 || everyinterval(100)) {
                x = myGameArea.canvas.width;
                minHeight = 150;
                maxHeight = 220;
                height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
                myObstacles.push(new component(25, 25, "red", x, 250, "objectspike"));
            }
            for (i = 0; i < myObstacles.length; i += 1) {
                myObstacles[i].x += -1;
                myObstacles[i].update();
            }

            for (i = 0; i < myObstaclesplatform.length; i += 1) {
                myObstaclesplatform[i].x += -1;
                myObstaclesplatform[i].update();
            }

            if (myGameArea.key && myGameArea.key == 32) {
                jump();
            }
            myScore.text="SCORE: " + myGameArea.frameNo;
            myScore.update();
            myGamePiece.newPos();
            myGamePiece.update();
        }
    function makeid()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

            for( var i=0; i < 5; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        function everyinterval(n) {
            if((myGameArea.frameNo / n) % 1 == 0) {
                return true;
            }
            return false;
        }

        function accelerate() {
            myGamePiece.gravity = 0.1;
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