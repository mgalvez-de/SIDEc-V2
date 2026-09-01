# SIDEc v2 — Contexto del proyecto

Sistema de Información del Departamento de Ecotoxicología (SIDEc) del CREA, UCSC Talcahuano. Práctica de salida intermedia de Matías Gálvez. **Entrega: 5 de diciembre de 2026.**

## Regla de trabajo más importante

**El código lo escribo yo (el estudiante), no Claude.** Cuando pida ayuda, prioriza explicar, revisar, señalar errores y discutir alternativas antes que escribir la implementación completa por mí. Si en algún momento pido explícitamente que generes un archivo o función completa, hazlo — pero por defecto, guía y explica en vez de resolver de una.

## Contexto: por qué existe este proyecto

Ya existe un SIDEc funcionando, hecho por otro estudiante en una práctica anterior (Laravel 8 + Blade + Bootstrap 5, repo: https://github.com/mgalvez-de/SIDEc). En vez de continuar ese código, se decidió reconstruirlo desde cero — mismo problema, mismo alcance funcional mínimo, pero arquitectura y diseño propios — para entender a fondo cómo funciona cada pieza y no solo terminar código ajeno.

## Decisiones de arquitectura (ya tomadas, no reabrir sin razón)

- **Backend:** Laravel 12 (el original usaba Laravel 8).
- **Frontend:** Blade + Tailwind CSS (el original usaba Bootstrap 5 — rediseño visual completo).
- **Base de datos:** MySQL corriendo en XAMPP local. El código se escribe en VS Code, no en el editor de XAMPP.
- **Autenticación:** Laravel Breeze (stack Blade) como base.
- **Roles y permisos:** Spatie Laravel Permission, con los **4 roles ya probados** en el original: `Analist`, `Supervisor`, `Manager`, `Area Manager`. (El SRS más nuevo del proyecto original describe 6 roles y funciones más avanzadas — 2FA, cifrado AES-256, firma digital — que nunca se implementaron. No se está replicando ese nivel de exigencia en esta v2 salvo decisión explícita en contrario.)

## Alcance funcional

**Núcleo:** autenticación con roles, dashboard con resumen de muestras/bioensayos en curso, gestión de plantillas maestras, recepción de muestras, rechazo de muestras (con trazabilidad), ingreso de muestras con parámetros fisicoquímicos (pH, salinidad, conductividad, O₂, temperatura).

**12 módulos de bioensayo** (organismo → cálculo principal):
- Daphnia magna agudo (48h) → CL50 — tiene ensayo preliminar + definitivo y temporizador
- Daphnia magna crónico (21 días) → NOEC / LOEC — mantención diaria durante 21 días
- Tisbe longicornis (agua) → CL50
- Tisbe longicornis (RILes) → CL50 — preliminar + definitivo
- Isochrysis galbana → EC50 (inhibición crecimiento algal marino)
- Selenastrum capricornutum → CE50 (inhibición crecimiento algal agua dulce)
- Arbacia fecundación → CI50 (ventana de 60 min)
- Arbacia estado larval → CE50

**Transversal:** exportación de informes (PDF/Excel), validación de formularios en tiempo real, diseño responsive (uso en tablet dentro del laboratorio).

## Esquema de datos de referencia (del sistema original, como punto de partida)

Tabla `templates` (maestra): `title`, `code`, `version`, `validity`, `type` (recepcion/bioensayo/rechazo/ingreso).

Tabla `reception_templates`: `template_id` (FK), `thermometer_code`, `correction_factor`, `received_at`, `delivered_by`, `client`, `sampled_at`, `received_by`, `sample_identifier`, `matrix`, `internal_sample_code`, `temperature_received`, `temperature_corrected`, `report_number`, `assigned_bioassays` (JSON).

Tabla `sample_entries`: `template_id` (FK), `received_at`, `internal_sample_code`, `sample_type`, `sample_concentration`, `parameter_reading_date`, `analyst`, `ph`, `salinity`, `conductivity`, `dissolved_oxygen`, `temperature`, `observations`, `state`.

Campos comunes a **todas** las tablas de bioensayo: `template_id` (FK), `timer_start` (o `preliminary_timer_start`/`definitive_timer_start` en los que tienen dos fases), `sample`, `matrix`, `analyst`, fechas de inicio/fin de ensayo, `observations`, y el/los resultado(s) final(es) (`cl50_24h`, `cl50_48h`, `ec50_detail`, `ci50`, etc.). Los datos de mediciones por réplica/concentración se guardan como JSON (`preliminary_table`, `definitive_24h`, `definitive_48h`, `rows_data`, etc.) — no como filas separadas.

## Fórmulas de cálculo (glosario)

- **CL50** (Concentración Letal 50): concentración que causa mortalidad al 50% de los organismos.
- **CE50** (Concentración Efectiva 50): concentración que causa un efecto (no necesariamente letal) en el 50%.
- **CI50** (Concentración de Inhibición 50): concentración que inhibe el 50% de un proceso (ej. fecundación).
- **NOEC/LOEC**: máxima concentración sin efecto observable / mínima concentración con efecto observable (comparación estadística vs. control, no una fórmula cerrada).
- **Tasa de crecimiento** (ensayos algales): μ = (ln(Nf) − ln(Ni)) / t
- **% Inhibición**: ((μ_control − μ_tratamiento) / μ_control) × 100

## Cronograma de referencia

Semana 1-2 (1-14 sept): proyecto base (Laravel 12 + Tailwind + Breeze + roles + layout + migraciones núcleo). Semana 3-4: Recepción/Rechazo/Ingreso completos. Semana 5-7: Daphnia agudo, Tisbe agua, Tisbe RILes. Semana 8: Daphnia crónico. Semana 9-10: Isochrysis, Selenastrum. Semana 11: Arbacia (fecundación y larval). Semana 12: dashboard + exportación + pulido. Semana 13: pruebas + documentación. Semana 14 (1-5 dic): buffer y presentación.
