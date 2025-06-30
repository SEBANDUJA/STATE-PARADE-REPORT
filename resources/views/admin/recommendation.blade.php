
@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Recommendation')

@section('content')
   <section class="pt-2">

      <!-- cards -->
      <!-- <span class="text-md font-semibold text-start mb-12">Select user to recommend</span>
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

      <div class="grid grid-cols-2 justify-items-between items-center gap-x-8 py-10 w-full">
         <form class="w-full shadow-md p-4">
            <div class="w-full">
               <label for="message" class="text-sm font-semibold">Your Message:</label><br>
               <textarea id="message" name="message" placeholder="Type your message here..." class="border-2 border-gray-300 w-full h-32 mt-4 px-3 rounded-md"></textarea>
            </div>
            <input type="text" name="send_to" value="" hidden/>
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

      </div> -->
      @if (session('success'))
         <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-400 alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
         </div>
      @endif

      @if (session('fail'))
         <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-400">
            {{ session('fail') }}
         </div>
      @endif

      @if ($errors->any())
         <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-400">
            <ul class="list-disc pl-5">
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
            </ul>
         </div>
      @endif

      <div x-data="{ selectedUser: '' }" class="w-full">

         <span class="text-md font-semibold text-start mb-12 block">Select user to recommend</span>
         
         <!-- User Grid -->
         <div class="grid grid-cols-5 justify-items-center items-center gap-4">
            <template x-for="(role, index) in ['Chief Officer (CO)', 'Chief Instructor (CI)', 'MTO', 'CC', 'Officer On Duty', 'Sergent Major', 'Orderly Corporal']" :key="index">
               <div 
                  @click="selectedUser = role" 
                  :class="selectedUser === role ? 'bg-orange-200 border-2 border-orange-500' : 'hover:bg-gray-300'" 
                  class="shadow-md w-full p-10 transition-all duration-500 ease-out cursor-pointer rounded text-center">
                  <span class="text-sm uppercase font-thin" x-text="role"></span>
               </div>
            </template>
         </div>

         <!-- Message Form -->
         <div class="grid grid-cols-2 justify-items-between items-center gap-x-8 py-10 w-full">
            <form class="w-full shadow-md p-4 mt-10" action="{{ route('recommendation.store') }}" method="POST">
               @csrf
               <div class="w-full">
                  <label for="message" class="text-sm font-semibold">Your Message:</label><br>
                  <textarea id="message" name="message" placeholder="Type your message here..." class="border-2 border-gray-300 w-full h-32 mt-4 px-3 rounded-md"></textarea>
               </div>
               <input type="text" name="send_to" :value="selectedUser" hidden />
               
               <div class="flex flex-row justify-between items-start gap-x-6 mt-6">
                  <div class="mb-4">
                     <span class="block mb-2">Who can see your message</span>
                     <div class="grid grid-cols-3 gap-2">
                        <template x-for="aud in ['CI', 'CC', 'MTO', 'OD', 'OC']" :key="aud">
                           <label class="inline-flex items-center space-x-2">
                              <input type="checkbox" name="audience[]" :value="aud" class="accent-orange-500">
                              <span x-text="aud"></span>
                           </label>
                        </template>
                     </div>
                  </div>

                  <div>
                     <button type="submit" class="h-10 w-fit px-8 rounded-md uppercase text-xs bg-orange-500 text-white flex items-center gap-2 cursor-pointer hover:bg-white hover:border-2 hover:border-orange-500 hover:text-black transition-all duration-500 ease-out">
                        <i class="fas fa-paper-plane"></i>
                        Send
                     </button>
                  </div>
               </div>
            </form>
            <div class="w-full shadow-md py-8 px-4">
            <h2 class="font-semibold">Recent Messages</h2>
            <div class="flex flex-col gap-y-6 mt-5">
            @foreach($recom as $recommendation)
               <div class="flex flex-row justify-start items-center gap-x-4 bg-gray-100">
                  <div class="w-10">
                     <img src="../images/nutcracker.png" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                  </div>
                  <div class="flex flex-col justify-start items-start">
                     <span class="font-semibold text-sm">{{ $recommendation->send_to }}</span>
                     <span class="text-gray-500">{{ $recommendation->message }}</span>
                  </div>

                  <div>
                     <div>

                     </div>
                     <div>
                        <span class="text-xs">{{ $recommendation->created_at }}</span>
                     </div>
                  </div>
                  <div>
                     <button class="w-fit h-8 px-3 rounded-md uppercase text-xs text-white bg-red-500 flex items-center gap-2 cursor-pointer hover:border-2 hover:border-red-500 hover:bg-white hover:text-black transition-all ease-out duration-500">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                     </button>
                  </div>
               </div>
            @endforeach   
            </div>

         </div>
         </div>
      </div>

   </section>
@endsection
