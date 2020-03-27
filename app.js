
const canvas = document.querySelector(".canvas");
const  ctx = canvas.getContext("2d");
const scale = 10;
const rows = canvas.height/scale;
const columns = canvas.width/scale;
let snake = [] ;
let ground = new Image();
ground.src = "img/ground.png";
let head = new Image();
head.src = "img/dau.png";
let foodImg = new Image();
foodImg.src = "img/food.png";
let score = 0;
let dead = new Audio();
let eat = new Audio();
let up = new Audio();
let right = new Audio();
let left = new Audio();
let down = new Audio();

dead.src = "audio/dead.mp3";
eat.src = "audio/eat.mp3";
up.src = "audio/up.mp3";
right.src = "audio/right.mp3";
left.src = "audio/left.mp3";
down.src = "audio/down.mp3";
// -----------------------draw-------------------------------
function setup() {
    snake = new Snake();
    food = new food();
    food.pickLocation();
  window.setInterval(() => {
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.drawImage(ground,0,0,300,300)
        food.draw();
        snake.update();
        snake.draw();
        if (snake.eat(food)){
            food.pickLocation();
            document.getElementById("point").innerHTML = snake.total;
        }
    },200);
};
setup();
window.addEventListener('keydown',((evt) => {
    const direction = evt.key.replace('Arrow','');
    snake.changeDirection(direction);
}));
// ------------------------food-------------
function food() {
    this.x = 0;
    this.y = 0;
    this.pickLocation = function () {
        this.x = (Math.floor(Math.random()* rows - 1)+1)* scale;
        this.y = (Math.floor(Math.random()* columns - 1)+1)* scale;
    };
    this.draw = function () {
        ctx.drawImage(foodImg,this.x,this.y,scale,scale);
    }
}
// ---------------------------snake--------------------------------------
 function Snake() {
    this.x = 0;
    this.y = 0;
    this.xSpeed = 0;
    this.ySpeed = 0;
    this.total = 0;
    this.tail = [];
    this.direction = "up";

    this.draw = function () {
        ctx.fillStyle = "#ffffff";
        for (let i = 0; i< this.tail.length; i++){
            // ctx.fillRect(this.tail[i].x, this.tail[i].y, scale,scale);
            ctx.drawImage(foodImg,this.tail[i].x,this.tail[i].y,scale,scale);
        }
        // ctx.fillRect(this.x, this.y, scale,scale);
        ctx.drawImage(head,this.x,this.y,scale,scale);

    };
    this.update = function () {
        for (let i = 0; i < this.tail.length - 1; i++) {
            this.tail[i] = this.tail[i + 1];
        }
        this.tail[this.total - 1] = {x: this.x, y: this.y};
        this.x += this.xSpeed;
        this.y += this.ySpeed;
        if (this.x > canvas.width) {
            dead.play();
            alert("GAME OVER");
            clearInterval(setup());
        }
        if (this.y > canvas.height) {
            dead.play();
            alert("GAME OVER");
            clearInterval(setup());
        }
        if (this.x < 0) {
            dead.play();
            alert("GAME OVER");
            clearInterval(setup());
        }
        if (this.y < 0) {
            dead.play();
            alert("GAME OVER");
            clearInterval(setup());
        }
        collision();
    };

    this.changeDirection = function (direction) {
        switch (direction) {
            case 'Up':
                if (this.direction != "Down"){
                    this.xSpeed = 0;
                    this.ySpeed = -scale;
                    this.direction ="Up";
                    up.play()
                }
                break;

            case 'Down':
                if (this.direction != "Up"){
                    this.xSpeed = 0;
                    this.ySpeed = scale;
                    this.direction ="Down";
                    down.play();
                }

                break;
            case 'Left':
                if (this.direction != "Right"){
                    this.ySpeed = 0;
                    this.xSpeed = -scale;
                    this.direction ="Left";
                    right.play();
                }

                break;
            case 'Right':
                if (this.direction != "Left"){
                    this.ySpeed = 0;
                    this.xSpeed = scale;
                    this.direction ="Right";
                    left.play();
                }

                break;
        }
    };
    this.eat = function (food) {
        if (this.x === food.x && this.y === food.y){
            this.total++;
            eat.play();
            return true;
        }
        return false;
    }
}

// cheack collision function
function isCollision(head,array){
    for(let i = 0; i < array.length; i++){
        if((snake.x === array[i].x && snake.y === array[i].y)){
            return true;
        }
    }
    return false;
}
// game over
function collision() {
    if (isCollision(snake.tail[0],snake.tail) )
    {
        dead.play();
        alert("GAME OVER");
        clearInterval(setup());
    }
}
