function criarMateria(form){
    let div = document.createElement('div');
    
    let label1 = document.createElement('label');
    label1.textContent = "Materia: "
    let input1 = document.createElement('input');
    input1.type = "text";
    input1.name = "materia[]";
    
    label1.appendChild(input1);
    
    let label2 = document.createElement('label');
    label2.textContent = "Professor: "
    let input2 = document.createElement('input');
    input2.type = "text";
    input2.name = "professor[]";

    label2.appendChild(input2);
    
    div.appendChild(label1);
    div.appendChild(label2);

    form.appendChild(div)
}

function convertArray(form, dado){
    inputs = document.querySelectorAll('input[name="'+dado+'"');
    array = []

    for(i=0; i<inputs.length; i++){
        array.push(inputs[i].value+" ");
    }

    inputs.forEach(element => {
        element.parentElement.remove();
    });

    let div = document.createElement('div');
    div.type = 'hidden'
    
    let label1 = document.createElement('label');
    label1.textContent = dado+": "
    let input1 = document.createElement('input');
    input1.type = "text";
    input1.name = dado;
    input1.value = array;
    
    label1.appendChild(input1);

    div.appendChild(label1);

    form.appendChild(div);
}