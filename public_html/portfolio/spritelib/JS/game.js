function init() { 
  var canvas = document.getElementById("myCanvas");
  var game = new Game(canvas);

  var player = game.getPlayer();
  player.setSprite(heli);
  player.setVelocity(3, 4);


  //COINS
  var myCoin, r, r2, r3;
  setInterval(this, function() {
    r = (Math.random()*10) + 1;
    if(r < 2) {
      myCoin = new Coin(canvas.width, (Math.random()*450)+64, 64, 64);
      myCoin.setSprite(coin);
      game.addCoin(myCoin);
    }
  }, 100);

  //WALLS
  var myWall, topWall, botWall, topWall2, botWall2, difficulty;
  botWall = new Wall(0, -63, 768, 110);
  topWall = new Wall(0, canvas.height-50, 768, 110);
  botWall.setImage(wall);
  topWall.setImage(wall);
  game.addWall(botWall);
  game.addWall(topWall);
  botWall = new Wall(768, -63, 768, 110);
  topWall = new Wall(768, canvas.height-50, 768, 110);
  botWall.setImage(wall);
  topWall.setImage(wall);
  game.addWall(botWall);
  game.addWall(topWall);
  
  difficulty = 800;
  setInterval(this, function() {
    myWall = new Wall(canvas.width+(Math.random()*100), (Math.random()*595), 45, 125);
    myWall.setImage(wall);
    game.addWall(myWall);
  }, difficulty);

  setInterval(this, function() {
    botWall = new Wall(768, -63, 768, 110);
    topWall = new Wall(768, canvas.height-50, 768, 110);
    botWall.setImage(wall);
    topWall.setImage(wall);
    game.addWall(botWall); 
    game.addWall(topWall);
  }, 1650);

  //ENEMIES
  var myEnemy;
  setInterval(this, function() {
    r = (Math.random()*10) + 1;
    r2 = (Math.random()*4) + 1;
    if(r < 8) {
      myEnemy = new Enemy(canvas.width, (Math.random()*450)+64, 110, 50);
      myEnemy.setSprite(enemy);
      if(r2 > 2) {
        myEnemy.setVelocity(5, r2/2);
      } else {
        myEnemy.setVelocity(5, -r2);
      }
      game.addEnemy(myEnemy);

    }
  }, 1000);

  game.addSprite(heli);
  game.addSprite(coin);
  game.addSprite(enemy);
  game.setBackground(bg);
  game.start(1/75);
} 
