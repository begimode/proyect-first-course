
function calcular(){

    var precioMinimo = 50;

    var selectKms = document.getElementById('kms');
    var selectH = document.getElementById('hecta');
    var selectS = document.getElementById('sensors');

    selectKms.addEventListener('change',
    function(){
        var selectedOptionKms = this.options[selectKms.selectedIndex];

        if(selectedOptionKms.value == "0_10k"){
            precioMinimo = precioMinimo + 30;
        } else if(selectedOptionKms.value == "10_50k"){
            precioMinimo = precioMinimo + 60;
        } else if (selectedOptionKms.value == "50_100k"){
            precioMinimo = precioMinimo + 90;
        } else if(selectedOptionKms.value == "100_200k"){
            precioMinimo = precioMinimo + 120;
        } else if(selectedOptionKms.value == "m200k"){
            precioMinimo = precioMinimo + 150;
        }
    });

    selectH.addEventListener('change',
    function(){
        var selectedOptionH = this.options[selectH.selectedIndex];

        if(selectedOptionH.value == "0_10h"){
            precioMinimo = precioMinimo + 50;
        } else if(selectedOptionH.value == "10_25h"){
            precioMinimo = precioMinimo + 100;
        } else if (selectedOptionH.value == "25_40h"){
            precioMinimo = precioMinimo + 150;
        } else if(selectedOptionH.value == "m40h"){
            precioMinimo = precioMinimo + 200;
        } 
    });


    selectS.addEventListener('change',
    function(){
        var selectedOptions = this.options[selectS.selectedIndex];

        if(selectedOptions.value == "unos"){
            precioMinimo = precioMinimo + 30;
        } else if(selectedOptions.value == "doss"){
            precioMinimo = precioMinimo + 60;
        } else if (selectedOptions.value == "tress"){
            precioMinimo = precioMinimo + 90;
        } else if(selectedOptions.value == "cuatros"){
            precioMinimo = precioMinimo + 120;
        } 
    });

    document.getElementById("precio").innerHTML = precioMinimo + "€"
}
