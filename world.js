window.onload = function (){
    let btn = document.querySelector("#lookup");
    let btnC = document.querySelector("#lookupC");
    let xhr = new XMLHttpRequest();
    let result = document.querySelector("#result");
    var input = document.querySelector("#country");

    xhr.addEventListener("load", () =>{
        let output = xhr.responseText;
        result.innerHTML = output;
    });

    btn.addEventListener("click", function(event){
        var url = 'world.php?country='+input.value;
        xhr.open('GET',url);
        xhr.send();
    });

    btnC.addEventListener("click", function(event){
        var url = 'world.php?country='+input.value+'&context=cities';
        xhr.open('GET',url);
        xhr.send();
    });
}