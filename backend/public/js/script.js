
$(function(){
 
  //talk_showにてenterキーで送信
  $("#message").keypress(function(event) {
    if (event.which == 13) {
      event.preventDefault();
      $("#talk-txt").submit();
    }
  });

  //talk_showにて最新の会話にスクロール
  $(window).on('load', function () {
    // 〜処理〜
    $('#talk-middle-scroll').animate({ scrollTop: $('#talk-middle-scroll')[0].scrollHeight }, 'fast');
  });
  
});

//桜吹雪
let sakura = [];
const SAKURA_MAX = 25;

class Sakura
{
  constructor()
  {
    this.elm = document.createElement("div");
    this.x = rand(0,window.innerWidth);
    this.y = rand(0,window.innerHeight);
    this.vx = rand(-5,5);
    this.vy = rand(2,5);
    this.rx = rand(0,10)/10;
    this.ry = rand(0,10)/10;
    this.rz = rand(0,10)/10;
    this.ag = 0;
    this.sp = rand(5,20);

    this.style = this.elm.style;
    this.style.position = "fixed";
    this.style.width = "15px";
    this.style.height = "10px";
    this.style.borderRadius = "10px";
    this.style.backgroundColor = "#FEEEED";

    document.body.appendChild(this.elm);
    this.update();
  }

  update()
  {
    this.x += this.vx;
    this.y += this.vy;
    if(this.y >= window.innerHeight)
    {
      this.y = -10;
      this.x = rand(0,window.innerWidth);
    }
    this.ag += this.sp;
    this.style.left = this.x + "px";
    this.style.top = this.y + "px";
    this.style.transform = "rotate3D(" + this.rx + "," + this.ry + "," + this.rz + "," + this.ag + "deg)";
  }
}

function rand(min, max)
{
  return Math.floor( Math.random()*(max-min+1) )+min;
}

function mainLoop()
{
  for(let i=0;i<SAKURA_MAX;i++)sakura[i].update();
}

window.onload = function()
{
  for(let i=0;i<SAKURA_MAX;i++)sakura.push(new Sakura());
  setInterval(mainLoop,1000/60);
}