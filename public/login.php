<!DOCTYPE html>
<html lang="<!DOCTYPE html>
<html lang="en" dir="rtl">

<?php 
session_start();
    if(!empty($_SESSION['username'])) {
       header("Location: " . '../public');
       exit;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ورود</title>
        <link rel="stylesheet" href="./styles/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
        <div id="login-form" 
        class=" flex bg-[#2121217a] backdrop-blur-[5px] items-center overflow-y-auto justify-center overflow-x-hidden fixed top-0 right-0 z-[1090] p-6 w-full h-modal h-full">
        <div class="w-full max-w-xl min-[1300px]:h-[auto] h-full">

            <div class="bg-white rounded-lg p-[24px] grid gap-[16px]">
                <div class="flex justify-between items-start rounded-t">
                    <div class="sm:text-2xl text-xl text-center font-bold text-[#585858]">
                        فرم ورود
                    </div>
                </div>

                <div class="pt-[16px]">
                    <div class="relative z-0 group grid grid-cols-1 mb-10">
                        <div class="relative z-0 w-full">
                            <div class="grid grid-cols-1">
                                    <input type="text" required name="username" id="username"
                                            class="px-4 border border-[#E5E5E5] rounded-[10px] block py-[12px] w-full text-sm text-gray-900 bg-transparent appearance-none" />
                                    <label
                                        class="mx-[30px] text-[#464B51] absolute text-[16px] top-[-11px] z-10 origin-[0] px-2 bg-[#F5F5F5]">
                                        نام کاربری
                                    </label>
                            </div>
                        </div>
                    </div>
                        <div class="relative z-0 group grid grid-cols-1 mb-10">
                        <div class="relative z-0 w-full">
                            <div class="grid grid-cols-1">
                                    <input type="text" required name="password" id="password"
                                            class="px-4 border border-[#E5E5E5] rounded-[10px] block py-[12px] w-full text-sm text-gray-900 bg-transparent appearance-none" />
                                    <label
                                        class="mx-[30px] text-[#464B51] absolute text-[16px] top-[-11px] z-10 origin-[0] px-2 bg-[#F5F5F5]">
                                        کلمه عبور
                                    </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 items-center justify-between">
                        <div class="grid grid-cols-1 items-center justify-between">
                            <button onclick="login()" type="button" id="login_button"
                                class="w-full flex items-center justify-center py-[8px] bg-green-400 rounded-[10px] text-[16px] font-bold text-white">
                                ورود
                            </button>
                        </div>
                        <div class="grid grid-cols-1 items-center justify-between">
                            <a href="./signup.php">حساب کاربری ندارید؟ ثبت نام</a>
                        </div>
                        <div id="message_form_login"
                            class="relative z-0 group grid grid-cols-1 gap-[16px]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <script src="./scripts/main.js""></script>
</html>