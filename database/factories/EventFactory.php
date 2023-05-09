<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\Category;
use App\Models\Time;
use App\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $names = [
            'Next.js - Aplicaciones con gran performance', 'MongoDB - Base de Datos a gran escala',
            'Tailwind y Figma', 'Vue.js con Django para gran Performance', 'WordPress y React - Gran Performance a costo 0',
            'React, Angular y Svelte - Creando un Proyecto', 'Laravel y Next.js - Aplicaciones Full Stack en Tiempo Record',
            'Remix - El Nuevo Framework de React', 'TailwindCSS - Crear Sitios Accesibles', 'TypeScript en React', 'Presente y Futuro del Frontend', 'Extiende la API de WordPress con PHP',
            'Node y Vue.js - Proyecto Práctico', 'GraphQL y Flutter - Gran Performance para Android y iOS', 'JavaScript - Apps para Web, Desktop y Escritorio',
            'Flutter y React Native - ¿Cómo elegir?', 'Laravel y Flutter - Creando Un Proyecto Real', 'Laravel y React Native - Creando un Proyecto Real',
            'PHP 8 - ¿Qué es Nuevo y que cambió?', 'MEVN Stack - Mongo Express  Vue.js y Node.js', 'Introducción a TailwindCSS', 'WPGraphQL y GatsbyJS - Headless WordPress',
            'Next.js - El Mejor Framework para React', 'React 18 - Una Introducción Práctica', 'Vue.js - Composition API', 'Vue.js - Pinia para reemplazar Vuex',
            'GraphQL - Introducción Práctica', 'React y TailwindCSS - Frontend Moderno'
        ];

        return [
            'name' => $this->faker->randomElement($names),
            'description' => $this->faker->paragraph(3),
            'available' => $this->faker->numberBetween(10, 100),
            'category_id' => Category::all()->random()->id,
            'day_id' => Day::all()->random()->id,
            'time_id' => Time::all()->random()->id,
            'speaker_id' => Speaker::all()->random()->id,
        ];
    }
}
