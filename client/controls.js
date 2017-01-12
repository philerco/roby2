var initOK = false;
var moveON = false;
var waiting = false;
var speed = 255;
var blockKey = false;

function move(direction){
 
  console.log(direction);
 
  if(initOK && !moveON && !waiting){
    
    waiting = true;
    
    $.ajax
      ({ 
	  url: 'ajax/move.php',
	  data: {"direction": direction},
	  type: 'post',
	  dataType: 'json',
	  success: function(data)
	  {        
		  console.log("move complete");
		  console.log(data);
		  waiting = false;
		  moveOn = true;
	  },
	  error:function(){
		console.log("cannot move");
		waiting = false;
	      }
      });
  }
}

function stop(){
 
  console.log("stop");
  
  if(initOK && moveOn && !waiting){
    
    waiting = true;
    
    $.ajax
    ({ 
        url: 'ajax/move.php',
        data: {"direction": "stop"},
        type: 'post',
        dataType: 'json',
        success: function(data)
        {        
                console.log("move complete");
		console.log(data);
		waiting = false;
		moveOn = false;
        },
        error:function(){
               console.log("cannot move");
	       waiting = false;
            }
    });
  }
}

function init(){
 
  $.ajax
  ({ 
      url: 'ajax/init.php',
      type: 'post',
      dataType: 'json',
      success: function(data)
      {        
	      console.log("init OK");
	      initOK = true;
      },
      error:function(){
	      console.log("cannot move");
	  }
  });
  
  
    $(window).keydown(function(event){
	
        if(blockKey == false){
            blockKey = true;
            switch(event.keyCode){
            case 38://haut
                move('haut');
                break;
            case 40://bas
                move('bas');
                break;
            case 37://gauche
                move('gauche');
                break;
            case 39://droite
                move('droite');
                break;
            case 107://+
                
                break;
            case 109://-
                    
                break;
            case 80://p
                    
                break;
            case 77://m
                break;
            case 33://page haut
                move('teteHaut');
                break;
            case 34://page bas
                move('teteBas');
                break;
            }
        }

	});
  
     $(window).keyup(function(event){
	
         blockKey = false;

       /* switch(event.keyCode){
        case 38://haut
            stop('haut');
            break;
        case 40://bas
            stop('bas');
            break;
        case 37://gauche
            stop('gauche');
            break;
        case 39://droite
            stop('droite');
            break;
        case 107://+
            
            break;
        case 109://-
                
            break;
        case 80://p
                
            break;
        case 77://m
            break;
        case 33://page haut
            stop('teteHaut');
            break;
        case 34://page bas
            stop('teteBas');
            break;
        }*/
     });
}

init();