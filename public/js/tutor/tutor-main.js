const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text"),
      container = body.querySelector(".container"),
      homebtn = body.querySelector(".home"),
      notifybtn = body.querySelector(".notify"),
      notification = body.querySelector(".notification"),
      classbtn = body.querySelector(".myclass"),
      classcontent = body.querySelector(".classes")


        toggle.addEventListener("click" , () =>{
            sidebar.classList.toggle("close");
            container.classList.toggle("close");
            notification.classList.toggle("close");
        })


        searchBtn.addEventListener("click" , () =>{
            sidebar.classList.remove("close");
          
        })

        // homebtn.addEventListener("click" , () =>{
        //     notification.classList.remove("active");
        //     container.classList.toggle("active");
        //     console.log('ok')
        // })

        notifybtn.addEventListener("click" , () =>{
            container.classList.remove("active");
            notification.classList.toggle("active");
            console.log('ok')
        })


        classbtn.addEventListener("click" , () =>{
            // notification.classList.remove("active");
            classcontent.classList.toggle("active");
            console.log('ok')
        })

        modeSwitch.addEventListener("click" , () =>{
            body.classList.toggle("dark");
            
            if(body.classList.contains("dark")){
                modeText.innerText = "Light mode";
            }else{
                modeText.innerText = "Dark mode";
                
            }
        });