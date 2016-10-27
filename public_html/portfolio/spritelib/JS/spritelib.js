/* 
 * This is the spritelib source file.
 */
constants = {
    TOPHIT: 1,
    BOTTOMHIT: 2,
    LEFTHIT: 3,
    RIGHTHIT: 4
}


  // Bullet
  var bullet_pic = new Image();
  bullet_pic.src = "Sprites/bullet.png";
  bullet_pic.flipx;

/*
 * Rectangle Object
 */
function Rect(x,y,width,height){
    this.x = x;
    this.y = y;
    this.width = width;
    this.height = height;
}

Rect.prototype = {
    setSize: function(width,height) {
        this.width = width;
        this.height = height;
    },
    setPos: function(x,y) {
        this.x = x;
        this.y = y;
    },
    inside: function(x,y) {
        if((x > this.x) && (x < this.x+this.width))
            if((y > this.y) && (y < this.y+this.height))
                return(true);
        return(false);
    },
    backHit: function(r) {
        if(this.x < r.x)
            return constants.LEFTHIT;
        if(this.x+this.width > r.x+r.width)
            return constants.RIGHTHIT;
        if(this.y < r.y)
            return constants.TOPHIT;
        if(this.y+this.height > r.y+r.height)
            return constants.BOTTOMHIT;
        return(0);
    },
    overlap: function(r) {
      if(this.x < r.x + r.width &&
         this.y < r.y + r.height &&
         this.x + this.width > r.x &&
         this.y + this.height > r.y){
        return true;
      }
      return false
    }
};

/*
 * Sprite Object
 */
function Sprite(x, y, width, height) {
    this.rect = new Rect(x,y,width,height);
    this.images = [];
    this.animations = [];
    this.current = 0;
    this.dx = 0;
    this.dy = 0;
    this.animation = [this.current];
    this.index = 0;
    this.flagx = 0;
    this.flagy = 0;
}

Sprite.prototype = {
    imageBase: function(image) {
        this.base = image;
    },
    addImage: function(x, y, width, height) {
        var rect = new Rect(x,y,width,height);
        this.images.push(rect);
    },
    addAnimation: function(name, seq) {
        this.animations[name] = seq;
    },
    animate: function(name) {
        this.animation = this.animations[name];
        this.current = this.animations[name][this.index];
    },
    flipx: function() {
        if(this.flagx)
            this.flagx = 0;
        else
            this.flagx = 1;
    },
    flipy: function() {
        if(this.flagy)
            this.flagy = 0;
        else
            this.flagy = 1;
    },
    draw: function(ctx) {
        var r = this.images[this.current];
        var r2 = this.rect;
        if(this.flagx || this.flagy) {
            ctx.save();
            ctx.translate((r2.x+r2.width/2),(r2.y+r2.height/2));
            if(this.flagx)
                ctx.scale(-1,1);
            if(this.flagy)
                ctx.scale(1,-1);
          ctx.translate(-(r2.x+r2.width/2),-(r2.y+r2.height/2));
        }
        ctx.drawImage(this.base,r.x,r.y,r.width,r.height,r2.x,r2.y,r2.width,r2.height);
        if(this.flagx || this.flagy) {
            ctx.restore();
        }
    },
    move: function(dt) {
        var x = this.rect.x;
        var y = this.rect.y;
        this.rect.setPos(x+this.dx*dt, y+this.dy*dt);
    },
    setPos: function(x,y) {
        this.rect.setPos(x,y);
    },
    setVelocity: function(vx, vy) {
        this.dx = vx;
        this.dy = vy;
    },
    hit: function(sp) {
        return(this.rect.inside(sp.rect.x,sp.rect.y));
    },
    hitB: function(r) {
        return(this.rect.backHit(r));
    },
    hitS: function(sp) {
        
    },
    step: function() {
        this.index = this.index+1;
        if(this.index >= this.animation.length)
            this.index = 0;
        this.current = this.animation[this.index];
    }
}

/*
 * Background Object
 */
function Background(x, y, width, height) {
    this.screenRect = new Rect(x,y,width,height);
    this.backRect = new Rect(x,y,width,height);
    this.image = null;
}

Background.prototype = {
    setImage: function(image) {
        this.image = image;
    },
    scroll: function(dx,dy) {
        this.backRect.setPos(this.backRect.x+dx,this.backRect.y+dy);
    },
    draw: function(ctx) {
        var r1 = this.backRect;
        var r2 = this.screenRect;
        if(this.image != null)
            ctx.drawImage(this.image,r1.x, r1.y, r1.width, r1.height, r2.x, r2.y, r2.width, r2.height);
    }
}

var __nativeST__ = window.setTimeout, __nativeSI__ = window.setInterval;

window.setTimeout = function (oThis, vCallback, nDelay ) {
    aArgs = Array.prototype.slice.call(arguments, 2);  
    return __nativeST__(vCallback instanceof Function ? function () {   
        vCallback.apply(oThis, aArgs);
    } : vCallback, nDelay);
};  

window.setInterval = function (oThis, vCallback, nDelay ) {
    aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeSI__(vCallback instanceof Function ? function () {
        vCallback.apply(oThis, aArgs);
    } : vCallback, nDelay);
};

/*
 * Game object.
 */
function Game(canvas) {
    this.sprites = [];
    this.walls = [];
    this.coins = [];
    this.enemies = [];
    this.bullets = [];
    this.background = null;
    this.player = new Player(canvas);
    this.running = 0;
    this.dt = 0.1
    this.canvas = canvas

    this.ammoText = new GameText(this.canvas);
    this.ammoText.setText("AMMO: " + this.player.ammo);
    this.ammoText.setPos(this.canvas.width - 170, 40);

    this.loseText = new GameText(this.canvas);
    this.loseText.setText("GAMEOVER");
    this.loseText.setPos((this.canvas.width/2)-100, (this.canvas.height/2)-25);

    this.counter = 0;
    this.score = 0;
    this.scoreText = new GameText(this.canvas);
    this.scoreText.setText("SCORE: " + this.score);
    this.scoreText.setPos(10, 40);
}

Game.prototype = {
    addSprite: function(sp) {
        this.sprites.push(sp);
    },
    removeSprite: function(sp) {
        var i = this.sprites.indexOf(sp);
        if(i >= 0)
            this.sprites.splice(i,1);
    },
    addWall: function(wall) {
        this.walls.push(wall);
    },
    removeWall: function(wall){
      var i = this.walls.indexOf(wall);
      if(i >= 0)
        this.walls.splice(i, 1);
    },
    addCoin: function(c) {
        this.coins.push(c);
    },
    removeCoin: function(c){
      var i = this.coins.indexOf(c);
      if(i >= 0)
        this.coins.splice(i, 1);
    },
    addEnemy: function(en) {
        this.enemies.push(en);
    },
    removeEnemy: function(en){
      var i = this.enemies.indexOf(en);
      if(i >= 0)
        this.enemies.splice(i, 1);
    },
    addBullet: function(b) {
        this.bullets.push(b);
    },
    removeBullet: function(b){
      var i = this.coins.indexOf(b);
      if(i >= 0)
        this.bullets.splice(i, 1);
    },
    setBackground: function(back) {
        this.background = back;
    },
    getPlayer: function(player) {
        return(this.player);
    },
    start: function(dt) {
        this.running = 1;
        this.dt = dt;
        this.loop();
    },
    stop: function() {
        this.running = 0;
    },
    loop: function() {
        var r;
        var i,j;
        var len = this.sprites.length;
        var len2 = this.walls.length;
        var len3 = this.coins.length;
        var len4 = this.enemies.length;
        var len5 = this.bullets.length;
        var hit = false;

        for(i=0; i<len; i++) {
            this.sprites[i].move(this.dt);
            this.sprites[i].step();
        }

        if(this.player.fire && (this.player.ammo > 0)) {
          var bullet = new Bullet(this.player);
          bullet.setImage(bullet_pic);
          this.addBullet(bullet);
          this.player.ammo = this.player.ammo - 1;
          this.player.fire = false;
        }

        for(i=0; i<len5; i++) {
          if(this.bullets[i].x < this.canvas.width && 
              this.bullets[i].x > 0) {
              this.removeBullet(this.bullets[i]);
              len5 = this.bullets.length;
          }
          for(j=0; j<len4; j++) {
            if(this.bullets[i].rect.overlap(this.enemies[j].rect)) {
              this.removeEnemy(this.enemies[j]);
              len4 = this.enemies.length;
              this.removeBullet(this.bullets[i]);
              len5 = this.bullets.length;
              this.score = this.score + 100;
            }
          }
        }

        for(i=0; i<len2; i++) {
            if(this.player.rect.overlap(this.walls[i].rect)) {
              this.running = 0;
            }
        }

        for(j=0; j<len3; j++) {
          if(this.player.rect.overlap(this.coins[j].rect)) {
            this.removeCoin(this.coins[j]);
            hit = true;
            len3 = this.coins.length; 
          }
       }

       for(i=0; i<len4; i++) {
          if(this.player.rect.overlap(this.enemies[i].rect)) {
            this.running = 0;
          }
       }

        if(this.background) {
             for(i=0; i<len; i++) {
                 r=this.sprites[i].hitB(this.background.backRect);
                 if((r > 0) && (this.sprites[i].collideB)) {
                     this.sprites[i].collideB(r);
                     len = this.sprites.length;
                 }
             }
        }
        cancelLoop: for(i=0; i<len; i++) {
            if(this.sprites[i].collide) {
                for(j=0; j<len; j++) {
                    if((i!=j) && this.sprites[i].hit(this.sprites[j])) {
                        this.sprites[i].collide();
                        break cancelLoop;
                    }
                }
            }
        }

        var ctx = this.canvas.getContext("2d");
        ctx.clearRect(0,0,this.canvas.width,this.canvas.height);
        if(this.background)
            this.background.draw(ctx);
        len = this.sprites.length;
        for(i=0; i<len; i++) {
            this.sprites[i].draw(ctx);
        }

        len2 = this.walls.length;
        for(i=0; i<len2; i++) {
            this.walls[i].draw(ctx);
        }

        len3 = this.coins.length;
        for(i=0; i<len3; i++) {
            this.coins[i].draw(ctx);
        }

        len4 = this.enemies.length;
        for(i=0; i<len4; i++) {
            this.enemies[i].draw(ctx);
        }

        len5 = this.bullets.length;
        for(i=0; i<len5; i++) {
          this.bullets[i].draw(ctx);
        }
        if(this.counter == 10) {
          this.score = this.score + 1;
          this.counter = 0;
        }

        // TEXT
        this.counter = this.counter + 1;
        this.scoreText.setText("SCORE: " + this.score);
        this.scoreText.draw(ctx);
        if(hit)
          this.player.ammo = this.player.ammo + 1;
        this.ammoText.setText("AMMO: " + this.player.ammo);
        this.ammoText.draw(ctx);
        this.player.draw(ctx);
        if(this.running) {
           // setTimeout(this.loop.bind(this),this.dt*1000);
          setTimeout(this, this.loop, this.dt*1000);
        } else {
          this.loseText.draw(ctx);
        }
    }
}

function Player(canvas) {
    this.up = false;
    this.down = false;
    this.left = false;
    this.right = false;
    this.fireBool = false;
    this.canvas = canvas;
    this.x = 25;
    this.y = (canvas.height/2)-55;
    this.sprite = null;
    this.dx = 15;
    this.dy = 15;
    this.ammo = 10;
    var blist = document.getElementsByTagName("body");
    blist[0].addEventListener("keydown", PlayerKeyDown.bind(this), true);
    blist[0].addEventListener("keyup", PlayerKeyUp.bind(this), true);
    canvas.focus();
    this.rect = new Rect(this.x, this.y, 110, 70);
}

function PlayerKeyDown(event) {
    var leftArrow = 37;
    var rightArrow = 39;
    var downArrow = 40;
    var upArrow = 38;
    var spaceBar = 32;
    
    if(event.keyCode == leftArrow) {
      this.left = true;
    } else if(event.keyCode == rightArrow) {
      this.right = true;
    } else if(event.keyCode == upArrow) {
      this.up = true;
    } else if(event.keyCode == downArrow) {
      this.down = true;
    } else if(event.keyCode == spaceBar) {
      this.fire = true;
    }
    event.stopPropagation();
}

function PlayerKeyUp(event) {
    var leftArrow = 37;
    var rightArrow = 39;
    var downArrow = 40;
    var upArrow = 38;
    var spaceBar = 32;
    console.log("up");
    
    if(event.keyCode == leftArrow) {
      this.left = false;
    } else if(event.keyCode == rightArrow) {
      this.right = false;
    } else if(event.keyCode == upArrow) {
      this.up = false;
    } else if(event.keyCode == downArrow) {
      this.down = false;
    }  else if(event.keyCode == spaceBar) {
      this.fire = false;
    }
    event.stopPropagation();
}

Player.prototype = {
    setPos: function (x, y) {
        this.x = x;
        this.y = y;
        this.rect.x = this.x;
        this.rect.y = this.y;
        if(this.sprite)
            this.sprite.setPos(this.x, this.y);
    },
    setSprite: function(sp) {
        this.sprite = sp;
    },
    setVelocity: function(vx, vy) {
        this.dx = vx;
        this.dy = vy;
    },
    draw: function(ctx) {
        if(this.left && this.x > 0) {
          this.setPos(this.x-this.dx, this.y);
        }
        if(this.right && this.x < 250) {
          this.setPos(this.x+this.dx, this.y);
        } 
        if(this.up) {
          this.setPos(this.x, this.y-this.dy);
        } 
        if(this.down) {
          this.setPos(this.x,this.y+this.dy);
        } 
        if(this.fire) {
          
        }

        if(this.sprite)
            this.sprite.draw(ctx);
    }
}

// WALLS

function Wall(x, y, width, height) {
  this.rect = new Rect(x,y,width,height);
  this.image = null;
  this.dx = 5;
  this.x = x;
  this.y = y;
}

Wall.prototype = {
  setImage: function(image) {
      this.image = image;
  },
  setPos: function (x, y) {
      this.x = x;
      this.y = y;
  },
  draw: function(ctx) {
      var r1 = this.image;
      var r2 = this.rect;
      this.rect.x = this.rect.x - this.dx;
      if(this.image != null)
          ctx.drawImage(this.image,r1.x, r1.y, r1.width, r1.height, r2.x, r2.y, r2.width, r2.height);
  }
}

// Coins
function Coin(x, y, width, height) {
  this.sprite = null;
  this.dx = 5;
  this.dy = 0;
  this.x = x;
  this.y = y;
  this.rect = new Rect(this.x, this.y, width, height);
}

Coin.prototype = {
  setPos: function (x, y) {
      this.x = x;
      this.y = y;
      this.rect.x = this.x;
      this.rect.y = this.y;
      if(this.sprite)
          this.sprite.setPos(this.x, this.y);
  },
  setSprite: function(sp) {
      this.sprite = sp;
  },
  draw: function(ctx) {
      this.setPos(this.x-this.dx, this.y);
      this.sprite.draw(ctx);
  }
}

// Enemy
function Enemy(x, y, width, height) {
  this.rect = new Rect(this.x, this.y, width, height);
  this.sprite = null;
  this.dx = 5;
  this.dy = 2;
  this.x = x;
  this.y = y;
}

Enemy.prototype = {
    setPos: function (x, y) {
        this.x = x;
        this.y = y;
        this.rect.x = this.x;
        this.rect.y = this.y;
        if(this.sprite)
            this.sprite.setPos(this.x, this.y);
    },
    setVelocity: function(vx, vy) {
      this.dx = vx;
      this.dy = vy;
    },
    setSprite: function(sp) {
        this.sprite = sp;
    },
    draw: function(ctx) {
        this.setPos(this.x-this.dx, this.y-this.dy);
        this.sprite.draw(ctx);
    }
}

// Bullet
function Bullet(player) {
  this.player = player;
  this.x = player.x + 100;
  this.y = player.y + 30;
  this.rect = new Rect(this.x, this.y, bullet_pic.width, bullet_pic.height);
  this.dx = 10;
  this.dy = 0;
  this.image = null;
}

Bullet.prototype = {
  setImage: function(image) {
      this.image = image;
  },
  setPos: function (x, y) {
      this.x = x;
      this.y = y;
  },
  draw: function(ctx) {
      var r1 = this.image;
      var r2 = this.rect;
      this.rect.x = this.rect.x + this.dx;
      if(this.image != null)
          ctx.drawImage(this.image,r1.x, r1.y, r1.width, r1.height, r2.x, r2.y, r2.width, r2.height);
  }
}

// GAME TEXT
function GameText(c) {
  this.canvas = c;
  this.x = 0;
  this.y = 0;
  this.str = "";
}

GameText.prototype = {
  setText: function(text) {
    this.str = text;
  },
  setPos: function(x, y) {
    this.x = x;
    this.y = y;
  },
  draw: function(ctx) {
    ctx.font = "30px Verdana";
    ctx.fillText(this.str, this.x, this.y);
  }
}