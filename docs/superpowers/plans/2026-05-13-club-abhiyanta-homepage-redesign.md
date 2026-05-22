# Club Abhiyanta Homepage Redesign Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Redesign the Club Abhiyanta homepage with new hero section, quick stats, and "What We Do" section using dark modern theme.

**Architecture:** Component-based modular approach updating existing CSS and PHP templates with new design system while maintaining database integration.

**Tech Stack:** PHP, MySQL, CSS3, HTML5, JavaScript (AOS animations)

---

### Task 1: Update CSS Design System

**Files:**
- Modify: `assets/css/style.css`

- [ ] **Step 1: Update CSS variables for new color scheme**

Update the :root section in style.css with new colors:

```css
:root {
  /* Updated Color Scheme */
  --primary-bg: #121212;
  --secondary-bg: #1a1a1a;
  --card-bg: #1e1e1e;
  --text-main: #ffffff;
  --text-muted: #b0b0b0;
  --accent-color: #E53935;
  --border-color: #333333;
  --hover-bg: #2a2a2a;

  /* Updated Typography */
  --font-heading: 'Poppins', sans-serif;
  --font-body: 'Montserrat', sans-serif;
}
```

- [ ] **Step 2: Update hero section styles**

Modify the .hero class styles:

```css
.hero {
  background: linear-gradient(135deg, var(--primary-bg) 0%, var(--secondary-bg) 100%);
  color: var(--text-main);
  padding: 8rem 0 4rem;
  position: relative;
  overflow: hidden;
}

.hero h1 {
  font-family: var(--font-heading);
  font-size: clamp(2.5rem, 5vw, 4rem);
  font-weight: 800;
  margin-bottom: 1rem;
}

.hero .highlight-text {
  color: var(--accent-color);
}

.hero p {
  font-family: var(--font-body);
  font-size: 1.125rem;
  color: var(--text-muted);
  margin-bottom: 2rem;
}
```

- [ ] **Step 3: Update button styles**

Modify button classes:

```css
.btn-primary {
  background: var(--accent-color);
  color: white;
  border: none;
  padding: 1rem 2rem;
  border-radius: 12px;
  font-family: var(--font-body);
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: #d32f2f;
  transform: translateY(-2px);
}

.btn-secondary {
  background: transparent;
  color: var(--text-main);
  border: 2px solid var(--border-color);
  padding: 1rem 2rem;
  border-radius: 12px;
  font-family: var(--font-body);
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  border-color: var(--accent-color);
  color: var(--accent-color);
}
```

- [ ] **Step 4: Commit CSS updates**

```bash
git add assets/css/style.css
git commit -m "feat: update CSS design system with new dark theme colors and typography"
```

### Task 2: Redesign Hero Section

**Files:**
- Modify: `index.php:7-31`

- [ ] **Step 1: Update hero section content**

Replace the hero section in index.php:

```php
<!-- Enhanced Hero Section -->
<section class="hero" style="margin-top: 5vw;" role="banner" aria-labelledby="hero-heading">
    <div class="hero-glow" aria-hidden="true"></div>
    <div class="hero-glow" aria-hidden="true"></div>
    <div class="container">
        <div class="hero-content reveal text-center">
            <span class="hero-badge" data-aos="fade-down" data-aos-delay="200">CLUB ABHIYANTA-BIT</span>
            <h1 id="hero-heading">Innovate <span class="highlight-text">•</span> Build <span class="highlight-text">•</span> Inspire</h1>
            <p data-aos="fade-up" data-aos-delay="400">
                Engineering | AI | Robotics | Innovation
            </p>
            <div class="hero-btns" data-aos="fade-up" data-aos-delay="600">
                <a href="pages/membership.php" class="btn btn-primary" role="button" aria-label="Join Club Abhiyanta membership">
                    Join Club <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="#activities" class="btn btn-secondary" role="button" aria-label="View our activities">
                    View Activities
                </a>
            </div>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Update hero badge styling**

Add new CSS for hero badge:

```css
.hero-badge {
  display: inline-block;
  background: var(--accent-color);
  color: white;
  padding: 0.5rem 1.5rem;
  border-radius: 25px;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  margin-bottom: 2rem;
}
```

- [ ] **Step 3: Test hero section display**

Open http://localhost/club/ and verify:
- Hero section shows new title and subtitle
- Buttons are styled correctly
- Text is centered and readable

- [ ] **Step 4: Commit hero section changes**

```bash
git add index.php assets/css/style.css
git commit -m "feat: redesign hero section with new content and styling"
```

### Task 3: Add Quick Stats Section

**Files:**
- Modify: `index.php` (after hero section)
- Create: Database queries for dynamic stats

- [ ] **Step 1: Add quick stats section HTML**

Insert after the hero section in index.php:

```php
<!-- Quick Stats Section -->
<section class="stats-section container reveal" aria-labelledby="stats-heading">
    <div class="stats-grid">
        <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-icon">👥</div>
            <div class="stat-number">
                <?php
                $memberCount = $conn->query("SELECT COUNT(*) as count FROM members WHERE status = 'active'")->fetch_assoc()['count'];
                echo $memberCount . '+';
                ?>
            </div>
            <div class="stat-label">Members</div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-icon">📅</div>
            <div class="stat-number">
                <?php
                // Count activities that are events
                $eventCount = $conn->query("SELECT COUNT(*) as count FROM activities WHERE action LIKE '%event%' OR action LIKE '%workshop%'")->fetch_assoc()['count'];
                echo $eventCount;
                ?>
            </div>
            <div class="stat-label">Events</div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-icon">🚀</div>
            <div class="stat-number">
                <?php
                // For now, show static count until projects table is created
                echo '5';
                ?>
            </div>
            <div class="stat-label">Projects</div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="500">
            <div class="stat-icon">🏫</div>
            <div class="stat-number">BIT</div>
            <div class="stat-label">Community</div>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Add stats section CSS**

Add styles for the stats section:

```css
.stats-section {
  padding: 4rem 0;
  background: var(--secondary-bg);
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

.stat-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: 16px;
  padding: 2rem;
  text-align: center;
  transition: all 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-5px);
  border-color: var(--accent-color);
  box-shadow: 0 10px 30px rgba(229, 57, 53, 0.1);
}

.stat-icon {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.stat-number {
  font-family: var(--font-heading);
  font-size: 2.5rem;
  font-weight: 800;
  color: var(--accent-color);
  margin-bottom: 0.5rem;
}

.stat-label {
  font-family: var(--font-body);
  font-size: 1rem;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.1em;
  font-weight: 600;
}
```

- [ ] **Step 3: Test stats section**

Verify database queries work and stats display correctly:
- Check member count shows actual number
- Event count shows from activities table
- Cards are properly styled and responsive

- [ ] **Step 4: Commit stats section**

```bash
git add index.php assets/css/style.css
git commit -m "feat: add quick stats section with dynamic database integration"
```

### Task 4: Update What We Do Section

**Files:**
- Modify: `index.php` (existing core pillars section)

- [ ] **Step 1: Update section content**

Replace the existing "Our Core Philosophy" section:

```php
<!-- What We Do Section -->
<section id="activities" class="container reveal" aria-labelledby="activities-heading">
    <div class="section-header">
        <span class="section-badge">What We Do</span>
        <h2 id="activities-heading">Driving <span class="highlight-text">Innovation</span> Through Action</h2>
        <p class="section-description">
            From technical workshops to social activities, we create opportunities for every member to learn, build, and grow.
        </p>
    </div>

    <div class="card-grid" role="list">
        <article class="premium-card reveal" role="listitem" data-feature="workshops">
            <div class="card-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;" aria-hidden="true">
                <i class="fas fa-cogs" title="Technical Workshops icon"></i>
            </div>
            <h3>Technical Workshops</h3>
            <p>Hands-on sessions covering AI, web development, IoT, and emerging technologies. Learn by building real projects.</p>
        </article>

        <article class="premium-card reveal" role="listitem" data-feature="projects">
            <div class="card-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;" aria-hidden="true">
                <i class="fas fa-lightbulb" title="Innovation Projects icon"></i>
            </div>
            <h3>Innovation Projects</h3>
            <p>Collaborative projects where creativity meets technology. From smart devices to AI applications.</p>
        </article>

        <article class="premium-card reveal" role="listitem" data-feature="competitions">
            <div class="card-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;" aria-hidden="true">
                <i class="fas fa-trophy" title="Competitions icon"></i>
            </div>
            <h3>Competitions</h3>
            <p>Hackathons, coding challenges, and tech competitions to test skills and showcase talent.</p>
        </article>

        <article class="premium-card reveal" role="listitem" data-feature="social">
            <div class="card-icon" style="background: rgba(236, 72, 153, 0.1); color: #ec4899;" aria-hidden="true">
                <i class="fas fa-users" title="Social Activities icon"></i>
            </div>
            <h3>Social Activities</h3>
            <p>Community building events, networking sessions, and fun activities that strengthen our bonds.</p>
        </article>
    </div>
</section>
```

- [ ] **Step 2: Update premium card styling**

Enhance the card styles:

```css
.premium-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: 16px;
  padding: 2rem;
  text-align: center;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.premium-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: var(--accent-color);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.premium-card:hover::before {
  transform: scaleX(1);
}

.premium-card:hover {
  border-color: var(--accent-color);
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(229, 57, 53, 0.15);
}

.card-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  margin: 0 auto 1.5rem;
}

.premium-card h3 {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: var(--text-main);
}

.premium-card p {
  font-family: var(--font-body);
  color: var(--text-muted);
  line-height: 1.6;
}
```

- [ ] **Step 3: Test What We Do section**

Verify the section displays correctly with new content and styling.

- [ ] **Step 4: Commit What We Do updates**

```bash
git add index.php assets/css/style.css
git commit -m "feat: update What We Do section with new content and enhanced styling"
```

### Task 5: Update Theme Colors Throughout

**Files:**
- Modify: `assets/css/style.css`

- [ ] **Step 1: Update existing component colors**

Update any remaining hardcoded colors to use CSS variables:

```css
/* Update section headers */
.section-badge {
  color: var(--accent-color);
  background: rgba(229, 57, 53, 0.1);
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-family: var(--font-heading);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

/* Update text colors */
.section-header h2 {
  color: var(--text-main);
}

.section-description {
  color: var(--text-muted);
}
```

- [ ] **Step 2: Update values track colors**

Update the innovations track:

```css
.innovations-track {
  background: var(--primary-bg);
  border-top: 1px solid var(--border-color);
  border-bottom: 1px solid var(--border-color);
}

.track-item {
  color: var(--accent-color);
  font-family: var(--font-heading);
  font-weight: 700;
}
```

- [ ] **Step 3: Test theme consistency**

Check that all sections use the new color scheme consistently.

- [ ] **Step 4: Commit theme updates**

```bash
git add assets/css/style.css
git commit -m "feat: update theme colors throughout the site for consistency"
```

### Task 6: Add Google Fonts

**Files:**
- Modify: `includes/header.php`

- [ ] **Step 1: Update font imports**

Update the Google Fonts link in header.php:

```html
<!-- Google Fonts (Poppins & Montserrat) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

- [ ] **Step 2: Test font loading**

Verify fonts load correctly and text displays with new typography.

- [ ] **Step 3: Commit font updates**

```bash
git add includes/header.php
git commit -m "feat: add Poppins and Montserrat fonts for new typography"
```

### Task 7: Final Testing and Polish

**Files:**
- Test: All modified files

- [ ] **Step 1: Test homepage loading**

Open http://localhost/club/ and verify:
- Hero section displays correctly
- Stats show dynamic data
- All sections styled properly
- Mobile responsiveness works

- [ ] **Step 2: Test database queries**

Run test script to ensure database connections work:

```bash
php -r "
include 'includes/db.php';
$members = \$conn->query('SELECT COUNT(*) as count FROM members WHERE status = \"active\"')->fetch_assoc()['count'];
echo \"Active members: \$members\n\";
\$conn->close();
"
```

- [ ] **Step 3: Check browser console**

Ensure no JavaScript errors and AOS animations work.

- [ ] **Step 4: Commit final updates**

```bash
git add -A
git commit -m "feat: complete homepage redesign with all components implemented"
```