---
name: Physical Innovation Lab
colors:
  surface: '#fafaf3'
  surface-dim: '#dadad4'
  surface-bright: '#fafaf3'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f4f4ee'
  surface-container: '#eeeee8'
  surface-container-high: '#e8e8e2'
  surface-container-highest: '#e3e3dd'
  on-surface: '#1a1c19'
  on-surface-variant: '#5c403d'
  inverse-surface: '#2f312d'
  inverse-on-surface: '#f1f1eb'
  outline: '#906f6c'
  outline-variant: '#e5bdba'
  surface-tint: '#bc111e'
  primary: '#a10014'
  on-primary: '#ffffff'
  primary-container: '#c81d25'
  on-primary-container: '#ffddda'
  inverse-primary: '#ffb3ad'
  secondary: '#5f5e5e'
  on-secondary: '#ffffff'
  secondary-container: '#e2dfde'
  on-secondary-container: '#636262'
  tertiary: '#4e4e4e'
  on-tertiary: '#ffffff'
  tertiary-container: '#666666'
  on-tertiary-container: '#e6e4e4'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdad6'
  primary-fixed-dim: '#ffb3ad'
  on-primary-fixed: '#410003'
  on-primary-fixed-variant: '#930011'
  secondary-fixed: '#e5e2e1'
  secondary-fixed-dim: '#c8c6c5'
  on-secondary-fixed: '#1c1b1b'
  on-secondary-fixed-variant: '#474746'
  tertiary-fixed: '#e4e2e2'
  tertiary-fixed-dim: '#c7c6c6'
  on-tertiary-fixed: '#1b1c1c'
  on-tertiary-fixed-variant: '#464747'
  background: '#fafaf3'
  on-background: '#1a1c19'
  surface-variant: '#e3e3dd'
typography:
  display:
    fontFamily: Montserrat
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Montserrat
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Montserrat
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  headline-md:
    fontFamily: Montserrat
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Montserrat
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Montserrat
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Montserrat
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.05em
  code:
    fontFamily: Montserrat
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 8px
  sm: 16px
  md: 24px
  lg: 48px
  xl: 80px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
---

## Brand & Style

This design system embodies the atmosphere of a world-class R&D facility: sterile but warm, precise but inviting, and relentlessly focused on the future. It blends **Minimalism** with **High-Contrast** accents to create a high-end startup aesthetic that feels like a physical laboratory space.

The visual narrative is built on the concept of "Structured Light." It utilizes a "White-on-White" layering technique to simulate architectural depth, where high-contrast typography and the signature Engineering Red act as functional indicators—much like laser-leveled markings on a factory floor. The aesthetic is unapologetically technical, favoring clarity and structural integrity over decorative flourish.

## Colors

The palette is anchored by the **Creamy White (#F5F5F0)** background, which provides a warmer, more sophisticated feel than a standard digital white, mimicking the matte finish of laboratory surfaces.

- **Primary (Engineering Red):** Reserved strictly for action, critical status, and innovation highlights. Use sparingly to maintain its impact.
- **Surface:** Pure white (#FFFFFF) is used for cards and elevated containers to create a "light-filled" layered effect against the creamy backdrop.
- **Typography:** Deep Black (#1A1A1A) is used for headlines to ensure maximum authority, while Dark Gray (#707070) handles secondary metadata and body text.
- **Border/Divider:** A subtle neutral (#EBEBE5) provides structural definition without breaking the minimal aesthetic.

## Typography

This design system utilizes **Montserrat** exclusively to maintain a geometric, technical appearance. 

- **Headlines:** Use Bold (700) weights with slightly tight letter spacing to create a sense of density and engineering precision.
- **Labels:** Small caps or uppercase with increased tracking (letter spacing) should be used for technical data, category labels, and small UI hints to mimic industrial labeling systems.
- **Body:** Regular (400) weight ensures high legibility against the creamy background.
- **Hierarchy:** High contrast in size between display text and body copy is encouraged to create a dynamic, modern startup rhythm.

## Layout & Spacing

The layout follows a **Fixed Grid** philosophy on desktop (12 columns, 1200px max-width) to ensure a controlled, architectural composition. On mobile, it transitions to a 4-column fluid system.

Spacing is generous, emphasizing the "light-filled" aspect of the brand. Use large `xl` margins between major sections to allow the design to "breathe," simulating the wide-open floor plan of a modern lab. All components and layouts should align to a 4px baseline grid to maintain technical rigor.

## Elevation & Depth

Depth is achieved through **Tonal Layers** rather than heavy shadows. The base layer is the creamy background, and the primary interactive layer is the pure white surface.

- **Surface Tiers:** Use a thin, 1px border (#EBEBE5) instead of shadows for most cards. This creates a "flat-spec" look consistent with engineering blueprints.
- **Elevated State:** Only use shadows for "Floating" elements like modals or dropdowns. These should be extremely soft, low-opacity (5-10%), and highly diffused (20px-40px blur) to avoid a "heavy" digital feel.
- **Micro-Depth:** Use subtle 2px offsets for active buttons to provide tactile feedback without relying on skeuomorphism.

## Shapes

In alignment with the **ROUND_FOUR** directive, this design system uses a precise geometric radius. 

A base radius of **0.5rem (8px)** is used for standard components like buttons and input fields. For larger layout containers and cards, a **1rem (16px)** radius is applied. This "Soft-Geometric" approach balances the hardness of the engineering theme with the approachability of a premium consumer brand. Interactive elements should never be fully pill-shaped unless they are status tags or chips.

## Components

- **Buttons:** Primary buttons are Solid Engineering Red with white text. Secondary buttons use a white background with a 1px Dark Gray border. Typography in buttons must be Semi-Bold and centered.
- **Input Fields:** Use a white surface with a subtle neutral border. On focus, the border transitions to Dark Gray—never the primary red, unless there is an error.
- **Chips & Tags:** Small, rectangular with an 8px radius. Use the neutral color for backgrounds with Dark Gray text to keep them unobtrusive.
- **Cards:** White surfaces (#FFFFFF) on the creamy background. Cards should feature generous internal padding (min 24px) to emphasize the minimal, high-end aesthetic.
- **Checkboxes/Radios:** Square-ish with 4px radius. When active, use Engineering Red with a clean white checkmark or dot.
- **Data Tables:** High-density, minimal borders, using the `label-md` style for headers to maintain a technical, lab-report feel.
- **Status Indicators:** Use Engineering Red for "Live/Active" or "Danger," but rely on Dark Gray for "Idle" to maintain the sophisticated color balance.