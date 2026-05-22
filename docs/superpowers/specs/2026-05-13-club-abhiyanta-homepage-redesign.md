# Club Abhiyanta Homepage Redesign Design Document

## Overview
Complete redesign of the Club Abhiyanta homepage with new content structure, dark modern theme, and component-based architecture.

## Design System
- **Colors**: Black (#121212), Red (#E53935), White
- **Fonts**: Poppins (headings), Montserrat (body)
- **Style**: Dark + modern, tech feel, minimal

## Architecture
- Component-based modular approach
- Update existing CSS with new design system
- Maintain PHP backend integration
- Progressive enhancement strategy

## Homepage Structure

### 1. Hero Section
- **Layout**: Centered content with background effects
- **Content**:
  - Main Title: "CLUB ABHIYANTA-BIT"
  - Subtitle: "Innovate • Build • Inspire"
  - Subtext: "Engineering | AI | Robotics | Innovation"
  - Buttons: "Join Club" and "View Activities"
- **Styling**: Dark background, red accent text, modern typography

### 2. Quick Stats Section
- **Layout**: 4-column grid with animated counters
- **Stats** (dynamic from database):
  - 👥 24+ Members (from members table count)
  - 📅 Events: X (from events/activities table count)
  - 🚀 Projects: X (from projects table count)
  - 🏫 BIT Community (static badge)
- **Styling**: Cards with hover effects, gradient backgrounds

### 3. What We Do Section
- **Layout**: 2x2 grid of feature cards
- **Activities**:
  - Technical Workshops
  - Innovation Projects
  - Competitions
  - Social Activities
- **Styling**: Premium cards with icons, consistent spacing

### 4. Existing Sections to Update
- Values Track: Keep with updated colors
- Leadership Section: Update styling to match new theme
- Footer: Update colors and fonts

## Implementation Plan
1. Update CSS variables with new color scheme
2. Implement hero section redesign
3. Add quick stats section with dynamic data
4. Redesign "What We Do" section
5. Update existing sections with new theme
6. Test responsiveness and animations

## Database Integration
- Member count: `SELECT COUNT(*) FROM members WHERE status = 'active'`
- Event count: `SELECT COUNT(*) FROM activities WHERE action LIKE '%event%'`
- Project count: `SELECT COUNT(*) FROM projects`

## Success Criteria
- Homepage loads with new design
- All sections display correctly
- Dynamic stats update properly
- Mobile responsive design maintained
- Dark theme applied consistently

## Technical Notes
- Update existing `style.css` with new design system
- Maintain existing PHP includes and database connections
- Preserve accessibility features and ARIA labels
- Keep animation library (AOS) integration