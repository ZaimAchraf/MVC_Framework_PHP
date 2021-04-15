
let SubCatSelectBox = document.getElementById('subCatID');
let CatSelectBox = document.getElementById('CatID');
let NoCatErrorBox = document.getElementById('noCat');

function getSubcategoriesOptions()
{
    let xml = new XMLHttpRequest();
    let cat = this.value;

    if(cat === ''){
        SubCatSelectBox.innerHTML = '';
        return;
    }

    xml.onreadystatechange=function(){
        if(xml.readyState === 4 && xml.status === 200){
            SubCatSelectBox.innerHTML = xml.responseText;
        }
    };
    xml.open('POST' ,"http://www.exemple.com:8080/ajax/getSubcategoriesOptions",true);
    xml.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    xml.send("ajax=true&CatID=" + cat);
}

CatSelectBox.addEventListener('change', getSubcategoriesOptions);

SubCatSelectBox.addEventListener('click', ()=>{
    if(CatSelectBox.value === ''){
        NoCatErrorBox.innerText = '*please choose one category first';
    }
});