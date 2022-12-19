using System;
using System.Collections;

function SeatingStudents(arr) { 

  // code goes here
  var K= arr[0];
  var ocupado = arr[1];
  int filas = (K/2);

  var sillas =arr;

  int x=0;

 foreach(int i in filas){
    //sillas.push
    foreach(int j in 2){
      if(x+1==ocupado){
        silla_vacia=true;
      }else{
        silla_vacia=false;
      }
      sillas[i].push(silla_vacia);
      x=+1;
    }
  }

  sentados =0;
  foreach(int i in (filas-1)){
    if((sillas[i][0]==false) && (sillas[i][1]==false)){
      sentados =+1;
    }
    
    if((sillas[i][0]==false) && (sillas[i+1][0]==false)){
      sentados = +1;
    }
    if((sillas[i][1]==false) && (sillas[filas-1][1]==false)){
      sentados = +1;
    }
  }
  
  if((sillas[filas-1][0]==false) && (sillas[filas-1][1]==false)){
      sentados =+1;
  }


    return sentados; 



  //return arr; 

}
   
// keep this function call here 
console.log(SeatingStudents(readline()));