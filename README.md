# Project technologies
MySQL DB + Laravel (Website is on Ukrainian lang)

# Project functionality
Allows to diagnose problems with user's car via dialogue, where user is asked about having noticed certain symptoms. (the symptoms about which system asks user - are the most relevant symptoms between all malfunctions that user possibly has, considering his previous answers on having certain symptoms. In this way each user's answer makes user closer to getting result (except for cases when user presses "I don't know")

![image](https://github.com/tri-white/car-expert_system/assets/92664974/07b18448-9ef8-4c32-90eb-963813b40eb2)

![image](https://github.com/tri-white/car-expert_system/assets/92664974/1a7f7408-b662-431e-973c-076199b6446f)

![image](https://github.com/tri-white/car-expert_system/assets/92664974/7cd88d05-eb0b-413b-9ece-2ddc1c7562b2)

![image](https://github.com/tri-white/car-expert_system/assets/92664974/ba62082e-6185-41a7-bfdb-a5e7aeea113d)

# Installation

1. composer install
2. config .env
3. php artisan key:generate
4. php artisan migrate
5. php artisan serve

