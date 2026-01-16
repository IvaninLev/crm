<script setup>

</script>

<template>
    <div class="flex min-h-screen">
        <!-- Левая часть (форма) -->
        <div class="h-full w-1/2 flex justxify-center items-center py-[68px]">
            <div class="flex flex-col items-center w-[437px]">
                <div class="self-start mb-8">
                    <slot name="link"/>
                </div>

                <!-- Логотип -->
                <img src="/img/logo.svg" class="mb-8 h-12">
                <p class="text-gray-500 text-center mb-12">
                    Provident similique accusantium memo autem. Veritatis obceccati tenetur lure eius earum ut molestias
                </p>

                <slot/>

                <div class="mt-auto py-8 text-center text-gray-500 text-sm">
                    <p>Revolutionizing the patent market</p>
                    <p class="mt-1">Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    <p class="mt-1">Namnra mullilla.</p>
                </div>
            </div>
        </div>
        <!-- див с картинкой -->
        <div class="bg-[#60AEA8] h-full w-1/2 flex items-center justify-center">
            <img src="/img/Login Screen Folder.svg" class="max-h-full max-w-full object-contain">
        </div>
    </div>
</template>

<style scoped>

</style>
