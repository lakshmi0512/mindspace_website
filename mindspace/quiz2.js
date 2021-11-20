let questions= [{
    "question": "1. Which of the following are real illnesses? " ,
    "option1": "A. Diabetes",
    "option2": "B. Anxiety",
    "option3": "C. Flu",                                                                   
    "option4": "D. All of the above",  
    "answer": "4"
    }, {
    "question": "2. In UK at any one time how many children in a class of 30 have a mental health problem?",
    "option1": "A. 5",
    "option2": "B. 3",
    "option3": "C. 10",
    "option4": "D. 20",
    "answer": "2"
    }, {
    "question": "3. Which of these symptoms can happen if you’re depressed?",
    "option1": "A. Don’t feel hungry",
    "option2": "B. Hungry all the time",
    "option3": "C. Always tired",
    "option4": "D. All of the above",
    "answer": "4"
    }, {
    "question": "4. How many children in Years 4 and 5 in BaNES told us they have been bullied in the last year?",
    "option1": "A. 1 in 10 (3 per class)",
    "option2": "B. 1 in 4 (7 per class) ",
    "option3": "C. 1 in 2 (15 per class)",
    "option4": "D. None",
    "answer": "2"
    }, {
    "question": "5. Who among the following people has experienced serious mental health problems?",
    "option1": "A.  Zayn Malik",
    "option2": "B. JK Rowling",
    "option3": "C. Lady Gaga",
    "option4": "D. All of the above",
    "answer": "4"
    }];
     let quest=document.getElementById("p3"),
        opt1=document.getElementById("p4"),
        opt2=document.getElementById("p5"),
        opt3=document.getElementById("p6"),
        opt4=document.getElementById("p7"),
        result=document.getElementById("p8");
    let currentQuestion=0;
    let score=0;
    let totalQuestion=questions.length;
    let h2=document.getElementsByTagName("h2")[0];
    let hours=0,minuits=0,seconds=0,t;
    function add(){
                seconds++;
                if(seconds>=60){
                    seconds=0;
                    minuits++;
                    
                if(minuits>=60){
                
                    minuits=0;
                    hours++;
                 }
                }
                h2.textContent =(hours ? (hours > 9 ? hours : "0" + hours) : "00")+ ":" +
                            (minuits ? (minuits > 9 ? minuits : "0" + minuits): "00")+ ":" +
                            (seconds? (seconds > 9 ? seconds : "0" + seconds) : "00");
    
                timer();
            }
        function timer() { 
            t= setTimeout(add,1000);
        }
        timer();
    function loadQuestion(qIndex){
        let a=questions[qIndex];
        quest.textContent = a["question"];
        opt1.textContent = a["option1"];
        opt2.textContent = a["option2"];
        opt3.textContent = a["option3"];
        opt4.textContent = a["option4"];
    
    }
    
    function loadNextQuestion(){
        let selectedOption=document.querySelector("input[type=radio]:checked");
        if(!selectedOption) {
            alert("select an option");
            return;
        }
        let yourAnswer=selectedOption.value;
        if(questions[currentQuestion].answer==yourAnswer) {
            score+=10;
        }
        selectedOption.checked=false;
        currentQuestion++;
        if(currentQuestion==totalQuestion-1){
            p1.textContent="finish";
        }
        if(currentQuestion==totalQuestion){
            p2.style.display="none";
            p8.style.display='';
            p1.style.display="none";
            p8.textContent= "Your score is  "+score+" out of 50. If you score more than 30 you are well versed with news regarding mental health. If your score is less than 30 then you need to read more and improve your knowledge on mental health.";
            clearTimeout(t);
    
        }
        if(currentQuestion<totalQuestion){
        loadQuestion(currentQuestion);
        }
    }
    
    loadQuestion(currentQuestion);