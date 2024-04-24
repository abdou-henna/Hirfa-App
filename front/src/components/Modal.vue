<template>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center  z-[100] "  dir="rtl">
      <div class="bg-white rounded-lg shadow-lg p-8 m-4 max-w-xl md:w-1/2 max-h-[70%] overflow-auto">
        <div class="flex justify-between items-center pb-3">
          <slot name="header"></slot>
          <div class="cursor-pointer z-50" @click="$emit('close')">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M12.45 11.75l-2.7-2.7 2.7-2.7L11.75 5l-2.7 2.7L6.35 5 5 6.35l2.7 2.7-2.7 2.7 1.35 1.35 2.7-2.7 2.7 2.7z"/>
            </svg>
          </div>
        </div>
        <slot></slot>
      </div>
    </div>
  </template>
  
