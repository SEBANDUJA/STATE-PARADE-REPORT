
@extends('layouts.admin')

@section('title', 'Recommendation')

@section('content')
   <section>

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

      <div class="grid grid-cols-2 justify-items-between items-center py-20 w-full">
         <form class="w-full">
            <div class="w-full">
               <label for="message">Your Message:</label><br>
               <textarea id="message" name="message" rows="5" cols="30" placeholder="Type your message here..." class="border-2 border-orange-500"></textarea>
            </div>
            <div class="flex flex-row gap-x-6">
               <div>
                  <select class="border-2 border-orange-500 h-10 w-fit px-10">
                     <option value="None">None</option>
                     <option value="CI">CI</option>
                     <option value="CC">CC</option>
                     <option value="MTO">MTO</option>
                     <option value="OD">OD</option>
                     <option value="OC">OC</option>
                  </select>
               </div>
               <div>
                  <button class="h-10 w-fit px-4 rounded-md uppercase text-xs bg-blue-500">Send</button>
               </div>
            </div>
         </form>

         <div class="w-full">
            <span>Send Messages</span>
         </div>
      </div>
   </section>
@endsection
