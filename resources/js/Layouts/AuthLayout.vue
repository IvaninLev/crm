<template>
    <div class="flex h-screen overflow-hidden">

        <!-- Левая часть (форма) -->
        <div class="w-full md:w-1/2 flex justify-center items-center px-6 md:px-0">
            <div class="flex flex-col w-full max-w-[437px] max-h-full">

                <div class="mb-6 md:mb-8">
                    <slot name="link"/>
                </div>

                <!-- Логотип -->
                <img src="/img/logo.svg" class="mb-6 md:mb-8 h-10 md:h-12">

                <p class="text-gray-500 text-center mb-8 md:mb-12 text-sm md:text-base">
                    Provident similique accusantium memo autem. Veritatis obceccati tenetur lure eius earum ut molestias
                </p>

                <slot/>

                <!-- Нижний текст -->
                <div class="mt-auto pt-6 md:pt-8 text-center text-gray-500 text-xs md:text-sm">
                    <p>Revolutionizing the patent market</p>
                    <p class="mt-1">Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    <p class="mt-1">Namnra mullilla.</p>
                </div>
            </div>
        </div>

        <!-- Правая часть (картинка) -->
        <div class="hidden md:flex bg-[#60AEA8] w-1/2 items-center justify-center overflow-hidden">
            <img src="/img/Login Screen Folder.svg" class="max-h-full max-w-full object-contain">
        </div>

    </div>
</template>
