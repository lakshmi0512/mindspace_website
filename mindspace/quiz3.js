function res()
{
    var s;
    s=0;
    var x=document.getElementById("formtest");
    var i;
    var flag;
    flag=0;
    for(i=0;i<x.length;i++)
    {
        if(parseInt(x.elements[i].value)>5 || parseInt(x.elements[i].value)<1)
        {
        alert("Enter values from 1 to 5 only in the test");
        break;
        flag=1;
        }
        else
        s=s+parseInt(x.elements[i].value);
    }
    if(flag==0)
    document.getElementById("result").innerHTML="Your Result is "+ s +" out of 75. If your score is more than 55 then you should consider talking about how you're feeling and vent out more, practice meditation, exercise everyday and eat healthy. If your score is more than 45, then you should take care of your mental health. If your score is less than 40, then you are perfectly healthy mentally."+"*If your score is NaN select a number between 1 to 5 for all the questions.";
    if(flag==1)
    document.getElementById("result").innerHTML="Please enter valid data";
    

}
