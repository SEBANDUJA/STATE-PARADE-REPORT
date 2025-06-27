
@extends('layouts.admin')

@section('title', 'Recommendation')

@section('content')
   <section class="pt-2">

      <!-- cards -->
      <span class="text-md font-semibold text-start mb-12">Select user to recommend</span>
      <div class="grid grid-cols-5 justify-items-center items-center">
         <div class="shadow-md w-full p-10 hover:bg-gray-300 transition-all duration-500 ease-out cursor-pointer">
            <span class="text-sm uppercase font-thin">Chief Officer (CO)</span>
         </div>
         <div class="shadow-md w-full p-10 hover:bg-gray-300 transition-all duration-500 ease-out cursor-pointer">
            <span class="text-sm uppercase font-thin">Chief Instructor (CI)</span>
         </div>
         <div class="shadow-md w-full p-10 hover:bg-gray-300 transition-all duration-500 ease-out cursor-pointer">
            <span class="text-sm uppercase font-thin">MTO</span>
         </div>
         <div class="shadow-md w-full p-10 hover:bg-gray-300 transition-all duration-500 ease-out cursor-pointer">
            <span class="text-sm uppercase font-thin">CC</span>
         </div>
         <div class="shadow-md w-full p-10 hover:bg-gray-300 transition-all duration-500 ease-out cursor-pointer">
            <span class="text-sm uppercase font-thin">Officer On Duty</span>
         </div>
         <div class="shadow-md w-full p-10 hover:bg-gray-300 transition-all duration-500 ease-out cursor-pointer">
            <span class="text-sm uppercase font-thin">Sergent Major</span>
         </div>
         <div class="shadow-md w-full p-10 hover:bg-gray-300 transition-all duration-500 ease-out cursor-pointer">
            <span class="text-sm uppercase font-thin">Orderly Corporal</span>
         </div>
      </div>

      <!-- messages section -->
      <div class="grid grid-cols-2 justify-items-between items-center gap-x-8 py-10 w-full">
         <form class="w-full">
            <div class="w-full">
               <label for="message" class="text-sm font-semibold">Your Message:</label><br>
               <textarea id="message" name="message" placeholder="Type your message here..." class="border-2 border-gray-300 w-full h-32 mt-4 px-3 rounded-md"></textarea>
            </div>
            <div class="flex flex-row justify-between items-start gap-x-6 mt-6">
               <div class="mb-4">
                  <span class="block mb-2">Who can see your message</span>
                  <div class="grid grid-cols-3 gap-2">
                     <label class="inline-flex items-center space-x-2">
                           <input type="checkbox" name="audience[]" value="CI" class="accent-orange-500">
                           <span>CI</span>
                     </label>
                     <label class="inline-flex items-center space-x-2">
                           <input type="checkbox" name="audience[]" value="CC" class="accent-orange-500">
                           <span>CC</span>
                     </label>
                     <label class="inline-flex items-center space-x-2">
                           <input type="checkbox" name="audience[]" value="MTO" class="accent-orange-500">
                           <span>MTO</span>
                     </label>
                     <label class="inline-flex items-center space-x-2">
                           <input type="checkbox" name="audience[]" value="OD" class="accent-orange-500">
                           <span>OD</span>
                     </label>
                     <label class="inline-flex items-center space-x-2">
                           <input type="checkbox" name="audience[]" value="OC" class="accent-orange-500">
                           <span>OC</span>
                     </label>
                  </div>
               </div>


               <div>
                  <button class="h-10 w-fit px-8 rounded-md uppercase text-xs bg-orange-500 text-white flex items-center gap-2 cursor-pointer hover:bg-white hover:border-2 hover:border-orange-500 hover:text-black transition-all duration-500 ease-out">
                     <i class="fas fa-paper-plane"></i>
                     Send
                  </button>
               </div>

            </div>
         </form>

         <div class="w-full shadow-md py-8 px-4">
            <h2 class="font-semibold">Recent Messages</h2>
            <div class="flex flex-col gap-y-6 mt-5">

               <div class="flex flex-row justify-start items-center gap-x-4 bg-gray-100">
                  <div class="w-10">
                     <img src="../images/nutcracker.png" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                  </div>
                  <div class="flex flex-col justify-start items-start">
                     <span class="font-semibold text-sm">Hlestacov Coder</span>
                     <span class="text-gray-500">Lorem Ipsum is simply dummy text of .....</span>
                  </div>

                  <div>
                     <div>

                     </div>
                     <div>
                        <span class="text-xs">10 JUNE 11:45</span>
                     </div>
                  </div>
                  <div>
                     <button class="w-fit h-8 px-3 rounded-md uppercase text-xs text-white bg-red-500 flex items-center gap-2 cursor-pointer hover:border-2 hover:border-red-500 hover:bg-white hover:text-black transition-all ease-out duration-500">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                     </button>
                  </div>
               </div>
               
               <div class="flex flex-row justify-start items-center gap-x-4 bg-gray-100">
                  <div class="w-10">
                     <img src="../images/soldier.png" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                  </div>
                  <div class="flex flex-col justify-start items-start">
                     <span class="font-semibold text-sm">Isabella John</span>
                     <span class="text-gray-500">Lorem Ipsum is simply dummy text of .....</span>
                  </div>

                  <div>
                     <div>

                     </div>
                     <div class="flex justify-end items-center">
                        <span class="text-xs">10 JUNE 11:45</span>
                     </div>
                  </div>
                  <div>
                     <button class="w-fit h-8 px-3 rounded-md uppercase text-xs text-white bg-red-500 flex items-center gap-2 cursor-pointer hover:border-2 hover:border-red-500 hover:bg-white hover:text-black transition-all ease-out duration-500">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                     </button>
                  </div>

               </div>

               <div class="flex flex-row justify-start items-center gap-x-4 bg-gray-100">
                  <div class="w-10">
                     <img src="../images/wildfire.jpg" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                  </div>
                  <div class="flex flex-col justify-start items-start">
                     <span class="font-semibold text-sm">Mathilde Andersen</span>
                     <span class="text-gray-500">Lorem Ipsum is simply dummy text of .....</span>
                  </div>

                  <div>
                     <div>

                     </div>
                     <div>
                        <span class="text-xs">10 JUNE 11:45</span>
                     </div>
                  </div>
                  <div>
                     <button class="w-fit h-8 px-3 rounded-md uppercase text-xs text-white bg-red-500 flex items-center gap-2 cursor-pointer hover:border-2 hover:border-red-500 hover:bg-white hover:text-black transition-all ease-out duration-500">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                     </button>
                  </div>
               </div>

               <div class="flex flex-row justify-start items-center gap-x-4 bg-gray-100">
                  <div class="w-10">
                     <img src="../images/soldier1.png" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                  </div>
                  <div class="flex flex-col justify-start items-start">
                     <span class="font-semibold text-sm">Nathanael Johnson</span>
                     <span class="text-gray-500">Lorem Ipsum is simply dummy text of .....</span>
                  </div>

                  <div>
                     <div>

                     </div>
                     <div>
                        <span class="text-xs">10 JUNE 11:45</span>
                     </div>
                  </div>
                  <div>
                     <button class="w-fit h-8 px-3 rounded-md uppercase text-xs text-white bg-red-500 flex items-center gap-2 cursor-pointer hover:border-2 hover:border-red-500 hover:bg-white hover:text-black transition-all ease-out duration-500">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                     </button>
                  </div>
               </div>
            </div>

         </div>

      </div>
   </section>
@endsection
