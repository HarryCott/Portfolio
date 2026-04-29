# VOID SOVEREIGN - Recruiter One-Pager

## Elevator Pitch
VOID SOVEREIGN is a modular real-time stream-overlay platform that ingests Twitch and operator events, applies scene-aware logic, and renders synchronized cinematic alerts, visuals, and narration for live broadcasts.

## Business/Product Value

- Upgrades viewer engagement through custom, high-impact live interactions
- Gives creators direct control with an operator dashboard and live telemetry
- Reduces stream-time failure risk through fallback-aware integration design
- Scales content style through configurable event rules and theming

## Core Engineering Highlights

- Queue-driven event orchestration for deterministic timing
- Multi-module runtime architecture split by responsibility (logic, alerts, voice, visuals, network, Twitch)
- OBS compatibility strategy across modern, legacy, and WebSocket pathways
- TTS reliability chain with provider fallback and safety timeout handling
- Live state sync between overlay runtime and control dashboard

## Notable Features

- Scene transitions: Starting Soon, BRB, Gameplay, Stream Ending
- Chat overlays with moderation-aware message removal
- Dynamic dice interaction commands (`!d6`, `!d20`, `!d100`, `!roll`)
- Music-aware visual style rules
- Corruption/enlightenment atmospheric state model
- Raid and cheer particle burst systems

## Technology Stack

- Frontend: HTML, CSS, JavaScript
- Integrations: Twitch (ComfyJS), OBS APIs/WebSocket, Spotify API
- Backend Relay: PHP + JSON state transport
- Audio: Browser media pipeline + proxied TTS

## Skills Demonstrated

- Real-time frontend architecture
- API and system integration under operational constraints
- UX design for live creator tooling
- Reliability engineering (de-duplication, fallbacks, graceful degradation)

## Candidate Talking Points (Interview)

1. Why queue orchestration matters for live event UX.
2. How fallback layers prevented stream-disrupting failures.
3. Tradeoffs between polling simplicity and WebSocket latency.
4. How modular boundaries improved iteration speed and testability.

## Source Access Note

The production implementation is private by design.
Private repository access or walkthroughs are available for vetted hiring processes.
