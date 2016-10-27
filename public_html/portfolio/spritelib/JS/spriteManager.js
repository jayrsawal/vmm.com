var heli, bg, wall, coin, enemy;

window.onload = function () {
  var canvas = document.getElementById("myCanvas");

  // Background
  bg = new Background(0, 0, 768, 720);
  var bg_pic = new Image();
  bg_pic.src = "Sprites/overworld_bg.png";
  bg.setImage(bg_pic);

  // Wall
  wall = new Image();
  wall.src = "Sprites/wall.png";

  // Player sprite
  heli = new Sprite(25, (canvas.height/2)-55, 122, 72);
  var es = new Image();
  es.src = "Sprites/plane.png";
  var seq = [0, 0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7];
  heli.imageBase(es);
  for(var i = 2; i < 5; i++) {
    for(var j = 0; j < 4; j++) {
        console.log("count");
        heli.addImage(j*122, i*72, 122, 72);
    }
  }
  heli.addAnimation("one", seq);
  heli.animate("one");
  heli.flipx();

  // Coin sprite
  coin = new Sprite(canvas.width, 100, 42, 42);
  var seq2 = [0, 1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 
  20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 
  39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 
  58, 59, 60, 61, 62, 63]
  var cs = new Image();
  cs.src = "Sprites/coins.png";
  coin.imageBase(cs);
  for(var i = 0; i < 8; i++) {
    for(var j = 0; j < 8; j++) {
      coin.addImage(j*64, i*64, 64, 64);
    }
  }
  coin.addAnimation("two", seq2);
  coin.animate("two");

  // Enemy sprite
  enemy = new Sprite(canvas.width, canvas.height/2, 122, 72);
  enemy.imageBase(es);
  for(var i = 0; i < 2; i++) {
    for(var j = 0; j < 4; j++) {
        console.log("count");
        enemy.addImage(j*122, i*72, 122, 72);
    }
  }
  enemy.addAnimation("three", seq);
  enemy.animate("three");

  init();
}