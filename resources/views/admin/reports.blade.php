<!DOCTYPE html><html lang="en" class="light" style=""><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet"><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">try{
    try {
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
              "surface-container-lowest": "#ffffff",
              "on-error": "#ffffff",
              "on-tertiary-fixed": "#161c22",
              "primary-container": "#1a2b3c",
              "outline-variant": "#c4c6cd",
              "tertiary": "#0f161b",
              "surface": "#fbf9fa",
              "on-tertiary-fixed-variant": "#41474e",
              "tertiary-container": "#242a30",
              "surface-container-high": "#e9e7e9",
              "secondary-fixed": "#d3e4fe",
              "secondary": "#505f76",
              "on-secondary-container": "#54647a",
              "on-primary-fixed": "#0b1d2d",
              "inverse-surface": "#303032",
              "on-tertiary": "#ffffff",
              "on-primary-fixed-variant": "#38485a",
              "surface-container-highest": "#e4e2e3",
              "surface-variant": "#e4e2e3",
              "inverse-on-surface": "#f2f0f2",
              "background": "#fbf9fa",
              "surface-dim": "#dbd9db",
              "surface-tint": "#4f6073",
              "inverse-primary": "#b7c8de",
              "on-error-container": "#93000a",
              "outline": "#74777d",
              "error-container": "#ffdad6",
              "on-primary-container": "#8192a7",
              "error": "#ba1a1a",
              "on-primary": "#ffffff",
              "secondary-container": "#d0e1fb",
              "on-background": "#1b1c1d",
              "primary": "#041627",
              "on-surface": "#1b1c1d",
              "on-secondary-fixed": "#0b1c30",
              "primary-fixed": "#d2e4fb",
              "tertiary-fixed": "#dde3eb",
              "on-tertiary-container": "#8b9198",
              "tertiary-fixed-dim": "#c1c7cf",
              "on-secondary-fixed-variant": "#38485d",
              "on-secondary": "#ffffff",
              "surface-container-low": "#f5f3f4",
              "primary-fixed-dim": "#b7c8de",
              "surface-container": "#efedef",
              "surface-bright": "#fbf9fa",
              "secondary-fixed-dim": "#b7c8e1",
              "on-surface-variant": "#44474c"
            },
            "borderRadius": {
              "DEFAULT": "0.25rem",
              "lg": "0.5rem",
              "xl": "0.75rem",
              "full": "9999px"
            },
            "spacing": {
              "base": "4px",
              "xl": "32px",
              "sm": "8px",
              "margin": "24px",
              "gutter": "20px",
              "lg": "24px",
              "md": "16px",
              "max-width": "1440px",
              "xs": "4px"
            },
            "fontFamily": {
              "title-md": ["Inter"],
              "display-lg": ["Inter"],
              "label-caps": ["Inter"],
              "headline-lg-mobile": ["Inter"],
              "body-sm": ["Inter"],
              "body-md": ["Inter"],
              "headline-lg": ["Inter"]
            },
            "fontSize": {
              "title-md": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
              "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
              "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
              "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
              "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
              "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
              "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
            }
          },
        },
      }
    } catch (_e) {}
  }catch(_e){}</script></head><body class="bg-background text-on-surface flex min-h-screen">

  <!-- SideNavBar -->
  <aside class="w-[260px] h-screen fixed left-0 top-0 bg-surface border-r border-outline-variant flex flex-col py-lg z-50">
<div class="px-lg mb-xl">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary">CarryOn</h1>
<p class="font-label-caps text-label-caps text-secondary tracking-widest uppercase">Admin Portal</p>
</div>
<nav class="flex-1 px-md space-y-base overflow-y-auto custom-scrollbar"><a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/overview">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-caps text-label-caps">Overview</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/users">
<span class="material-symbols-outlined">group</span>
<span class="font-label-caps text-label-caps">Users</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/classes">
<span class="material-symbols-outlined">school</span>
<span class="font-label-caps text-label-caps">Classes</span>
</a>
<a class="flex items-center gap-md px-md py-sm font-bold text-primary border-r-2 border-primary bg-surface-container-low transition-colors duration-150" href="#">
<span class="material-symbols-outlined">assessment</span>
<span class="font-label-caps text-label-caps">Reports</span>
</a></nav>
<div class="mt-auto px-md space-y-base border-t border-outline-variant pt-lg">
<a class="flex items-center gap-md px-md py-sm text-secondary hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined">help</span>
<span class="font-label-caps text-label-caps">Help</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:text-primary transition-colors" href="/login">
<span class="material-symbols-outlined">logout</span>
<span class="font-label-caps text-label-caps">Logout</span>
</a>
</div>
</aside>

  <!-- Main Content Area -->
  <main class="ml-[260px] flex-1 flex flex-col min-h-screen">
    
    <!-- TopAppBar -->
    

    <!-- Canvas -->
    <div class="max-w-[1440px] mx-auto w-full space-y-xl px-xl pb-xl pt-lg">
      
      <!-- Page Header -->
      <div class="pb-sm">
        <h1 class="font-headline-lg text-headline-lg text-primary">Platform Reports</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-sm">Detailed analytics and system-wide activity logs for institutional management.</p>
      </div>

      <!-- Report Generation (Vertical List) -->
      <section class="space-y-lg">
        <div class="border-b border-outline-variant/30 pb-sm">
          <h2 class="font-title-md text-title-md text-primary">Report Generation</h2>
          <p class="font-body-sm text-body-sm text-on-surface-variant">Select a report type to generate detailed analytics.</p>
        </div>
        
        <div class="flex flex-col gap-md">
          <!-- Enrollment Summary Row -->
          <div class="flex items-center gap-lg p-lg bg-surface-container-lowest border border-outline-variant/30 rounded-lg hover:border-primary/30 transition-all group">
            <div class="p-md bg-primary-container rounded-lg">
              <span class="material-symbols-outlined text-on-primary-container" data-icon="summarize">summarize</span>
            </div>
            <div class="flex-grow">
              <h3 class="font-title-md text-title-md text-primary">Enrollment Summary</h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant">Detailed breakdown for students and instructors by class, term, and department.</p>
            </div>
            <button class="py-sm px-xl bg-primary text-on-primary rounded-lg font-label-caps text-label-caps uppercase tracking-wider active:scale-95 transition-transform">Generate</button>
          </div>

          <!-- Contribution Fairness Row -->
          <div class="flex items-center gap-lg p-lg bg-surface-container-lowest border border-outline-variant/30 rounded-lg hover:border-primary/30 transition-all group">
            <div class="p-md bg-primary-container rounded-lg">
              <span class="material-symbols-outlined text-on-primary-container" data-icon="balance">balance</span>
            </div>
            <div class="flex-grow">
              <h3 class="font-title-md text-title-md text-primary">Contribution Fairness</h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant">Review the distribution of contribution scores across all groups to ensure equitable workload.</p>
            </div>
            <button class="py-sm px-xl bg-primary text-on-primary rounded-lg font-label-caps text-label-caps uppercase tracking-wider active:scale-95 transition-transform">Generate</button>
          </div>

          <!-- Completion Trends Row -->
          <div class="flex items-center gap-lg p-lg bg-surface-container-lowest border border-outline-variant/30 rounded-lg hover:border-primary/30 transition-all group">
            <div class="p-md bg-primary-container rounded-lg">
              <span class="material-symbols-outlined text-on-primary-container" data-icon="trending_up">trending_up</span>
            </div>
            <div class="flex-grow">
              <h3 class="font-title-md text-title-md text-primary">Completion Trends</h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant">Monitor task completion rates over time, segmented by class and instructor performance.</p>
            </div>
            <button class="py-sm px-xl bg-primary text-on-primary rounded-lg font-label-caps text-label-caps uppercase tracking-wider active:scale-95 transition-transform">Generate</button>
          </div>
        </div>
      </section>

      <!-- Recent Reports -->
      <section class="space-y-lg pt-md">
        <div class="border-b border-outline-variant/30 pb-sm">
          <h2 class="font-title-md text-title-md text-primary">Recent Reports</h2>
          <p class="font-body-sm text-body-sm text-on-surface-variant">Access and download your previously generated analytics files.</p>
        </div>
        <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-lg overflow-hidden shadow-sm">
          <div class="flex flex-col">
            <!-- Report Row 1 -->
            <div class="flex items-center justify-between p-lg border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors">
              <div class="flex items-center gap-md">
                <span class="material-symbols-outlined text-primary p-sm bg-surface-container rounded-lg" data-icon="description">description</span>
                <div>
                  <p class="font-body-md text-body-md text-primary font-medium">Enrollment Summary - Fall 2024</p>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">Oct 24, 2023, 10:45 AM</p>
                </div>
              </div>
              <div class="flex items-center gap-xl">
                <span class="font-body-sm text-body-sm text-outline">1.2 MB</span>
                <button class="flex items-center gap-sm py-sm px-md border border-primary text-primary rounded-lg font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary hover:text-on-primary transition-all active:scale-95">
                  <span class="material-symbols-outlined text-[18px]" data-icon="download">download</span>
                  Download
                </button>
              </div>
            </div>
            <!-- Report Row 2 -->
            <div class="flex items-center justify-between p-lg border-b border-outline-variant/10 hover:bg-surface-container-low transition-colors">
              <div class="flex items-center gap-md">
                <span class="material-symbols-outlined text-primary p-sm bg-surface-container rounded-lg" data-icon="description">description</span>
                <div>
                  <p class="font-body-md text-body-md text-primary font-medium">Contribution Fairness - CS101</p>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">Oct 22, 2023, 02:15 PM</p>
                </div>
              </div>
              <div class="flex items-center gap-xl">
                <span class="font-body-sm text-body-sm text-outline">850 KB</span>
                <button class="flex items-center gap-sm py-sm px-md border border-primary text-primary rounded-lg font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary hover:text-on-primary transition-all active:scale-95">
                  <span class="material-symbols-outlined text-[18px]" data-icon="download">download</span>
                  Download
                </button>
              </div>
            </div>
            <!-- Report Row 3 -->
            <div class="flex items-center justify-between p-lg hover:bg-surface-container-low transition-colors">
              <div class="flex items-center gap-md">
                <span class="material-symbols-outlined text-primary p-sm bg-surface-container rounded-lg" data-icon="description">description</span>
                <div>
                  <p class="font-body-md text-body-md text-primary font-medium">Completion Trends - Q3 Overview</p>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">Oct 20, 2023, 09:30 AM</p>
                </div>
              </div>
              <div class="flex items-center gap-xl">
                <span class="font-body-sm text-body-sm text-outline">2.4 MB</span>
                <button class="flex items-center gap-sm py-sm px-md border border-primary text-primary rounded-lg font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary hover:text-on-primary transition-all active:scale-95">
                  <span class="material-symbols-outlined text-[18px]" data-icon="download">download</span>
                  Download
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Footer -->
    
  </main>

  <script class="">
    // Micro-interactions
    document.querySelectorAll('button</script></body></html>