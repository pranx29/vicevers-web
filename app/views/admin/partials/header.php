<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ViceVersa - <?php echo $title ?></title>
    <base href="localhost/Ecommerce/public/">
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@100;200;300;400;600;700&display=swap"
        rel="stylesheet" />
</head>

<body class="bg-gradient-neutral-to-primary font-sans h-screen">

    <header class="bg-gradient-neutral-to-primary top-0 right-0 z-50 fixed left-[300px]">
        <div class="flex flex-row justify-between items-center p-5">
            <div class="flex justify-center items-end flex-col md:flex-row">
                <span class="text-contentColor1 font-semibold md:text-3xl text-2xl"><?= $title ?> </span>
            </div>
            <div class="flex justify-center items-center gap-x-5">
                <div class="flex flex-row items-center">
                    <div class="p-3 relative"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
    
                <?php if (isset($_SESSION['fname']) && isset($_SESSION['lname'])): ?>
                    <p class="font-semibold text-white text-2xl"><?= $_SESSION['fname'] . ' ' . $_SESSION['lname'] ?></p>
                <?php endif; ?>
    
            </div>
        </div>
        </div>
    </header>