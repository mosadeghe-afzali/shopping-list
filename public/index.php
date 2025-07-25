<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
session_start();
    if(!isset($_SESSION['username'])) {
       header("Location: " . '../public/login.php');
       exit;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List</title>
    <link rel="stylesheet" href="./styles/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <svg class="hidden">
        <symbol id="close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
            stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
         </symbol>
         <symbol id="pencil" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
        </symbol>
        <symbol id="trash" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </symbol>
    </svg>

    <div class="p-4 w-full sm:w-3/4 lg:w-1/2 mx-auto mt-15">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-10">
          <p class="text-2xl sm:text-xl mb-4 sm:mb-0"> <?php echo "نام کاربری:‌ " .  $_SESSION['username']; ?> </p>
          <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <a href="./login.php" class="bg-green-200 w-full sm:w-30 h-8 mx-auto">ورود|ثبت نام</a>
            <button onclick="logout()" class="bg-green-200 w-full sm:w-30 h-8 mx-auto">خروج</button>
          </div>
        </div>


        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-10">
          <h1 class="text-2xl sm:text-3xl mb-4 sm:mb-0">لیست خرید</h1>
          <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <button onclick="showItemPopup()" class="add-item bg-green-200 w-full sm:w-20 h-8">افزودن</button>
            <button onclick="showDeleteopup()" class="add-item bg-green-200 h-8 w-full sm:max-w-full truncate">حذف تجمیعی</button>
          </div>
        </div>
        <div class="order-card">
        <!-- from js -->
        </div>
      </div>

    <div id="insert-item" onclick="hiddenItemPopup(event)"
        class="bg-[#2121217a] backdrop-blur-[5px] items-center overflow-y-auto justify-center overflow-x-hidden fixed top-0 right-0 z-[1090] p-6 w-full h-modal h-full hidden">
        <div class="w-full max-w-xl min-[1300px]:h-[auto] h-full">
            <!-- Modal content -->
            <div class="bg-white rounded-lg p-[24px] grid gap-[16px]">
                <div class="flex justify-between items-start rounded-t">
                    <div class="sm:text-2xl text-xl text-center font-bold text-[#585858]">
                        فرم ثبت آیتم
                    </div>
                    <button onclick="closeItemPopup()" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm inline-flex items-center">
                    <svg class="w-8 h-8">
                        <use xlink:href="#close"></use>
                    </svg>
                    </button>
                </div>

                <div class="pt-[16px]">
                    <form id="insert-item-form" class="grid grid-cols-1">
                        <div class="grid  items-center grid-cols-1">
                            <div class="grid grid-cols-1 gap-x-[16px] gap-y-[20px] self-center w-full">

                                <div class="relative z-0 group grid grid-cols-1">
                                    <div class="relative z-0 w-full">
                                        <div class="grid grid-cols-1">
                                            <input type="text" required name="name" id="name"
                                                class="px-4 border border-[#E5E5E5] rounded-[10px] block py-[12px] w-full text-sm text-gray-900 bg-transparent appearance-none" />

                                            <label
                                                class="mx-[30px] text-[#464B51] absolute text-[16px] top-[-11px] z-10 origin-[0] px-2 bg-[#F5F5F5]">
                                                نام
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative z-0 group grid grid-cols-1">
                                    <div class="relative z-0 w-full">
                                        <div class="grid grid-cols-1">
                                            <input type="number" required name="price" id="price"
                                                class="px-4 border border-[#E5E5E5] rounded-[10px] block py-[12px] w-full text-sm text-gray-900 bg-transparent appearance-none" />

                                            <label
                                                class="mx-[30px] text-[#464B51] absolute text-[16px] top-[-11px] z-10 origin-[0] px-2 bg-[#F5F5F5]">
                                                قیمت
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative z-0 group grid grid-cols-1">
                                    <div class="relative z-0 w-full">
                                        <div class="grid grid-cols-1">
                                            <textarea type="text" required id="description" name="description"
                                                class="px-4 border border-[#E5E5E5] rounded-[10px] block py-[12px] w-full text-sm text-gray-900 bg-transparent appearance-none"></textarea>
                                            <label
                                                class="mx-[30px] absolute text-[16px] text-[#464B51] top-[-11px] z-10 origin-[0] px-2 bg-[#F5F5F5]">
                                                توضیحات
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="id">

                                <div class="grid grid-cols-1 items-center justify-between">
                                    <div class="grid grid-cols-1 items-center justify-between">
                                        <button onclick="submitItemFrom()" type="button" id="insert_button"
                                            class="w-full flex items-center justify-center py-[12px] bg-green-400 rounded-[10px] text-[20px] font-bold text-white">
                                            ثبت
                                        </button>
                                    </div>
                                    <div id="message_form"
                                        class="relative z-0 group grid grid-cols-1 gap-[16px]"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-item" onclick="hiddenConfirmDeletePopup(event)"
        class="bg-[#2121217a] backdrop-blur-[5px] items-center overflow-y-auto justify-center overflow-x-hidden fixed top-0 right-0 z-[1090] p-6 w-full h-modal h-full hidden">
        <div class="w-full max-w-xl min-[1300px]:h-[auto] h-full">
            <!-- Modal content -->
            <div class="bg-white rounded-lg p-[24px] grid gap-[16px]">
                <div class="flex justify-between items-start rounded-t">
                    <div class="sm:text-2xl text-xl text-center font-bold text-[#585858]">
                        حذف تجمیعی آیتم ها
                    </div>
                    <button onclick="closeConfirmDeletePopup()" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm inline-flex items-center">
                    <svg class="w-8 h-8">
                        <use xlink:href="#close"></use>
                    </svg>
                    </button>
                </div>

                <div class="pt-[16px]">
                    <div class="pb-8">
                    ایا از حذف دسته جمعی آیتم ها اطمینان دارید؟
                    </div>

                    <div class="grid grid-cols-1 items-center justify-between">
                        <div class="grid grid-cols-1 items-center justify-between">
                            <button onclick="submitDeleteItem()" type="button" id="delete_button"
                                class="w-full flex items-center justify-center py-[8px] bg-green-400 rounded-[10px] text-[16px] font-bold text-white">
                                تایید
                            </button>
                        </div>
                        <div id="message_form_delete"
                            class="relative z-0 group grid grid-cols-1 gap-[16px]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <script src="./scripts/main.js""></script>
</html>