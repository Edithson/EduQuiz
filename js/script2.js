
window.onload = function(){
    
    
    document.getElementById('show').addEventListener('click', function(e){
        form = document.getElementById('drap')
        form.style.display='inline-block';
        e.preventDefault()
    })
    document.getElementById('hide').addEventListener('click', function(e){
        document.getElementById('drap').style.display='none';
    })

var x
    document.getElementById('check').addEventListener('click', function(){
        //alert(x)
        if (x==0) {
            document.getElementById('nav_bar').style.marginLeft='0px';
            x=1
        }else{
            document.getElementById('nav_bar').style.marginLeft='-200px';
            x=0
        }
        
    })

    document.getElementById('conteneur').addEventListener('click', function(){
        if (x==1) {
            document.getElementById('nav_bar').style.marginLeft='-200px';
            x=0
        }
    })

}