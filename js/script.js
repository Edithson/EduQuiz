window.onload = function(){
    

    document.getElementById('show').addEventListener('click', function(e){
        form = document.getElementById('drap')
        form.style.display='inline-block';
        e.preventDefault()
    })
    document.getElementById('hide').addEventListener('click', function(e){
        document.getElementById('drap').style.display='none';
    })
    

    // var option = document.getElementsByClassName('matiere')
    // for (let index = 0; index < option.length; index++) {
    //     option[index].addEventListener('click', function(){
    //         var msg = this.value
    //         alert(msg)
    //     })
        
    // }
    var x
    document.getElementById('check').addEventListener('click', function(e){
        if (x==0) {
            document.getElementById('nav_bar').style.marginLeft='0px';
            x=1
        }else{
            document.getElementById('nav_bar').style.marginLeft='-200px';
            x=0
        }
        
    })
    
}
