const button= document.querySelector('button');
const input1 = document.getElementById('input1');
const input2 = document.getElementById('input2');
const input3 = document.getElementById('input3');



 input1.addEventListener('blur', () => {
    console.log(`Mon choix n°1 est ${input1.value} `)
});

 input2.addEventListener('blur', () => {
    console.log(`Mon choix n°2 est ${input2.value} `)

});

 input3.addEventListener('blur', () => {
    console.log(`Mon choix n°3 est ${input3.value} `)
});



button.addEventListener('click', (event) => {
  event.preventDefault();
  console.log(Number(input1.value));
  console.log(Number(input2.value));
  if (input1.value > input2.value){
    console.log(input1.value)
  } else {
    console.log(input2.value)
  }
});


input3.addEventListener('blur', () => {
if (input3.value ==""){
    input3.style.border ="red 1px solid" 
}
});


button.addEventListener('click', (event) => {
      event.preventDefault();
if (input3.value ==""){
    console.log("Renseigner le champ");
}
else {
    for (let i = 0; i < 10; i++) {input3.value*i}
}}
);