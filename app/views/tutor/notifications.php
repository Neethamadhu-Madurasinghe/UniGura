<?php

/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/tutor/inc/components/MainNavbar.php';

Header::render(
     'Tutor Notifications',
     [
          URLROOT . '/public/css/tutor/base.css?v=1.1',
          URLROOT . '/public/css/tutor/style.css?v=1.7',
          URLROOT . '/public/js/tutor/check-notification-count.js'
     ]
);

MainNavbar::render($request);
?>

<div class="New_Student_Request">
     <h2>Notifications</h2>
     <div class="msg_container_one">

     </div>

</div>

<script>
     let notifications = <?php echo $data['notifications'] ?>;
     const notification_container = document.querySelector('.msg_container_one');
     console.log(notifications);
     let root = '<?php echo URLROOT ?>';

     for (let value of notifications) {
          let button = ``;
          if (value.link !== null) {
               button = `<button data-link =${value.link} class="msg_box button">View Details</button>`;
          }

          let description = `<p></p>`;
          if(value.description !== null) {
              description = `<p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">${value.description}</p>`
          }

          let message = `<div data-id = ${value.id} class="msg_box_one">
               <div class="header">
                    <h4>${value.title}</h4>
                    <button class="close x"><i class="fa fa-times x"></i></button>
               </div>
               <div class="content">
                    ${description}
                    ${button}
               </div>
          </div>`

          notification_container.innerHTML += message;
     }

     notification_container.addEventListener('click', function(e) {
          if (e.target.classList.contains('button')) {
               let link = e.target.dataset.link;
               window.location.href = link;
          } else if (e.target.classList.contains('x')) {
               let container = e.target.closest('.msg_box_one');
               console.log(container.innerHTML)
               let id = container.getAttribute('data-id');
               console.log(id);
               container.style.display = 'none';

               fetch(`${root}/tutor/notifications/markasdelete`, {
                         method: 'POST',
                         body: new URLSearchParams({
                              id: id
                         })
                    })
                    .then(function(response) {
                         if (!response.ok) {
                              throw new Error('Network response was not ok');
                         }
                         return response.text();
                    })
                    .then(function(responseText) {
                         // display results in data container
                         console.log(JSON.parse(responseText));
                     
                    })
                    .catch(function(error) {
                         console.error('Error retrieving data:', error);

                    });
               //Give the fetch request to database to not show again
          }

          
     });

     fetch(`${root}/tutor/notifications/markasseen`, {
               method: 'GET'
          })
          .then(response => {
               if (response.ok) {
                    console.log('Table updated successfully!');
               } else {
                    response.text().then(errorMessage => {
                         console.error('Error updating table:', errorMessage);
                    });
               }
          })
          .catch(error => {
               console.error('Error:', error);
          });
</script>





<?php Footer::render(
     [
          URLROOT . '/public/js/tutor/tutor-main.js'
     ]
);
?>