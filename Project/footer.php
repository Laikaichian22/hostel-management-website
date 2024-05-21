<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        .footer
        {
            display:flex;
            justify-content: space-around;
            align-items: center;
            background-image:linear-gradient(150deg, #d0fccf 10%, #f39a15 100%);
            height: 100px;
        }

        .footer a{
            text-decoration: none;
        }
    </style>

</head>
<body>
    <?php
    echo ' <div class="footer">
            <div><a href="../information.html">More about us</a></div>
            <div><a href="../contact.html">Contact us</a></div>
            <div> <a href="mailto:shijunhui@graduate.utm.my">Email</a></div>
           </div>';
    ?>
</body>
</html>