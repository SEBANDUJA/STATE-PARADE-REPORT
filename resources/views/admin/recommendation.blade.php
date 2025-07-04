
@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Recommendation')
@section('page_title', 'Recommendation')

@section('content')
   <section class="pt-2">

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

            <!-- Recent Messages -->
            <div class="w-full shadow-md py-8 px-4">
               <h2 class="font-semibold">Recent Messages</h2>
               <div class="mt-5 max-h-60 overflow-y-auto flex flex-col gap-y-4">
                  @foreach($recom as $recommendation)
                     <div class="grid grid-cols-2 justify-items-between items-center gap-x-6 p-3 bg-gray-100 w-full">
                           <div class="flex flex-row gap-x-4 justify-items-start items-center">
                              <div class="w-10">
                                 <img src="../images/nutcracker.png" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                              </div>
                              <div class="flex flex-col justify-start items-start">
                                 <span class="font-semibold text-sm">{{ $recommendation->send_to }}</span>
                                 <span class="text-gray-500">{{ $recommendation->message }}</span>
                              </div>
                           </div>
                           <div class="flex flex-row gap-x-4 justify-items-end items-center">
                              <div>
                                 <div>
                                       <!-- optional actions -->
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
                     </div>
                  @endforeach  
               </div>
            </div>
         </div>
      </div>

   </section>
@endsection
