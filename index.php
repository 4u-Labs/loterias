<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Central das Loterias ✦ Super App de Análise & Palpites</title>
  
  <!-- PWA Meta Tags -->
  <link rel="manifest" href="manifest.json">
  <meta name="theme-color" content="#0c1020">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="Super Loterias">
  <link rel="apple-touch-icon" href="icons/icon-192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=20261120-2">
  <link rel="icon" type="image/x-icon" href="/favicon.ico?v=20261120-2">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-primary: #060913;
      --bg-secondary: #0c1020;
      --bg-card: rgba(18, 24, 43, 0.7);
      --bg-card-hover: rgba(26, 35, 62, 0.85);
      --border-color: rgba(255, 255, 255, 0.06);
      --border-color-active: rgba(255, 255, 255, 0.15);
      --text-primary: #f8fafc;
      --text-secondary: #94a3b8;
      --text-muted: #64748b;
      
      --accent-color: #20ab6e;
      --accent-glow: rgba(32, 171, 110, 0.18);
      --transition-speed: 0.3s;
      --radius-lg: 16px;
      --radius-md: 12px;
      --radius-sm: 8px;
    }

    /* Active Lottery Classes for Dynamic Colors */
    body.theme-megasena {
      --accent-color: #20ab6e;
      --accent-glow: rgba(32, 171, 110, 0.2);
    }
    body.theme-lotofacil {
      --accent-color: #a855f7;
      --accent-glow: rgba(168, 85, 247, 0.2);
    }
    body.theme-quina {
      --accent-color: #3b82f6;
      --accent-glow: rgba(59, 130, 246, 0.2);
    }
    body.theme-lotomania {
      --accent-color: #f97316;
      --accent-glow: rgba(249, 115, 22, 0.2);
    }
    body.theme-duplasena {
      --accent-color: #ef4444;
      --accent-glow: rgba(239, 68, 68, 0.2);
    }
    body.theme-timemania {
      --accent-color: #eab308;
      --accent-glow: rgba(234, 179, 8, 0.2);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-primary);
      color: var(--text-primary);
      min-height: 100vh;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
    }

    /* Layout Structure */
    .app-container {
      display: flex;
      flex: 1;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 280px;
      background-color: var(--bg-secondary);
      border-right: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      padding: 24px;
      gap: 32px;
      flex-shrink: 0;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: var(--text-primary);
    }

    .brand-logo {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 800;
      font-size: 20px;
      letter-spacing: -0.5px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .brand-logo span {
      color: var(--accent-color);
      transition: color var(--transition-speed);
    }

    .brand-subtitle {
      font-size: 11px;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 600;
      margin-top: -6px;
    }

    .nav-menu {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      border-radius: var(--radius-md);
      color: var(--text-secondary);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all var(--transition-speed) ease;
      background: transparent;
      border: 1px solid transparent;
    }

    .nav-item:hover, .nav-item.active {
      color: var(--text-primary);
      background-color: rgba(255, 255, 255, 0.03);
    }

    .nav-item.active {
      background-color: var(--accent-glow);
      border-color: rgba(255, 255, 255, 0.05);
      box-shadow: inset 0 0 12px rgba(255, 255, 255, 0.02);
    }

    .nav-item svg {
      width: 20px;
      height: 20px;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
      transition: stroke var(--transition-speed);
    }

    .nav-item.active svg {
      stroke: var(--accent-color);
    }

    .lottery-selector-title {
      font-size: 11px;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 700;
      margin-top: 16px;
      margin-bottom: 8px;
    }

    .lottery-grid {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .lottery-btn {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 16px;
      border-radius: var(--radius-md);
      background-color: rgba(255, 255, 255, 0.02);
      border: 1px solid var(--border-color);
      color: var(--text-secondary);
      cursor: pointer;
      font-size: 14px;
      font-weight: 600;
      transition: all var(--transition-speed);
      text-align: left;
    }

    .lottery-btn:hover {
      background-color: rgba(255, 255, 255, 0.05);
      border-color: var(--border-color-active);
      color: var(--text-primary);
    }

    .lottery-btn.active {
      border-color: var(--accent-color);
      background-color: var(--accent-glow);
      color: var(--text-primary);
    }

    .lottery-badge {
      font-size: 10px;
      padding: 2px 6px;
      border-radius: 4px;
      background-color: rgba(0,0,0,0.3);
      color: var(--text-muted);
    }

    .lottery-btn.active .lottery-badge {
      background-color: var(--accent-color);
      color: #fff;
    }

    /* Main Area */
    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      max-height: 100vh;
      padding: 32px;
      gap: 32px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: var(--bg-card);
      backdrop-filter: var(--glass-blur);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-lg);
      padding: 18px 24px;
    }

    .topbar-info h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 20px;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .topbar-info h2 span {
      color: var(--accent-color);
    }

    .topbar-meta {
      display: flex;
      gap: 24px;
      font-size: 13px;
      color: var(--text-secondary);
    }

    .meta-item {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .meta-label {
      color: var(--text-muted);
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .meta-value {
      font-weight: 600;
    }

    /* Pages Container */
    .page-view {
      display: none;
      flex-direction: column;
      gap: 24px;
    }

    .page-view.active {
      display: flex;
      animation: fadeIn 0.4s ease forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Grid and Panels */
    .grid-dashboard {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 24px;
    }

    .grid-2col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .panel {
      background-color: var(--bg-card);
      backdrop-filter: var(--glass-blur);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-lg);
      padding: 24px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      transition: border-color var(--transition-speed);
    }

    .panel:hover {
      border-color: var(--border-color-active);
    }

    .panel-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: var(--text-primary);
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 12px;
    }

    /* Draw Balls Styling */
    .draw-balls-container {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: flex-start;
      margin: 12px 0;
    }

    .ball {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 18px;
      color: #ffffff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3), inset 0 2px 4px rgba(255,255,255,0.4), inset 0 -4px 6px rgba(0,0,0,0.4);
      position: relative;
      user-select: none;
      transition: all var(--transition-speed) ease;
    }

    /* Color variations for ball backgrounds using dynamic class */
    .ball-megasena { background: radial-gradient(circle at 35% 35%, #58e0a1, #16804b); }
    .ball-lotofacil { background: radial-gradient(circle at 35% 35%, #d8b4fe, #7e22ce); }
    .ball-quina { background: radial-gradient(circle at 35% 35%, #93c5fd, #1d4ed8); }
    .ball-lotomania { background: radial-gradient(circle at 35% 35%, #fdba74, #ea580c); }
    .ball-duplasena { background: radial-gradient(circle at 35% 35%, #fca5a5, #dc2626); }
    .ball-timemania { background: radial-gradient(circle at 35% 35%, #fde047, #a16207); color: #000; text-shadow: none; box-shadow: 0 4px 10px rgba(0,0,0,0.3), inset 0 2px 4px rgba(255,255,255,0.6), inset 0 -4px 6px rgba(0,0,0,0.3); }

    .ball.ball-sm {
      width: 32px;
      height: 32px;
      font-size: 13px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.4);
    }

    .ball.highlighted {
      transform: scale(1.1);
      box-shadow: 0 0 15px var(--accent-color);
    }

    /* Small Stats Cards */
    .stat-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 14px;
      background-color: rgba(255,255,255,0.02);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-md);
      font-size: 13px;
    }

    .stat-row span:first-child {
      color: var(--text-secondary);
    }

    .stat-row span:last-child {
      font-weight: 600;
    }

    /* Generator Page Styling */
    .generator-layout {
      display: grid;
      grid-template-columns: 320px 1fr;
      gap: 24px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-size: 12px;
      font-weight: 600;
      color: var(--text-secondary);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-input, .form-select {
      background-color: #111827;
      border: 1px solid var(--border-color);
      border-radius: var(--radius-md);
      padding: 12px 16px;
      color: var(--text-primary);
      font-size: 14px;
      outline: none;
      transition: all var(--transition-speed);
      width: 100%;
    }

    .form-input:focus, .form-select:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 3px var(--accent-glow);
    }

    /* Visual Ticket Grid */
    .ticket-grid-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 16px;
      padding: 16px;
      background-color: rgba(0,0,0,0.2);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border-color);
    }

    .ticket-grid {
      display: grid;
      gap: 6px;
      max-width: 100%;
      user-select: none;
    }

    .ticket-num {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 600;
      color: var(--text-secondary);
      background-color: rgba(255, 255, 255, 0.03);
      border: 1px solid var(--border-color);
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .ticket-num:hover {
      background-color: rgba(255, 255, 255, 0.08);
      color: var(--text-primary);
      border-color: var(--border-color-active);
    }

    .ticket-num.fixed {
      background-color: var(--accent-color);
      color: #fff;
      border-color: var(--accent-color);
      box-shadow: 0 0 10px var(--accent-glow);
    }

    .ticket-num.excluded {
      background-color: #ef4444;
      color: #fff;
      border-color: #ef4444;
      position: relative;
    }
    
    .ticket-num.excluded::after {
      content: '×';
      position: absolute;
      font-size: 18px;
      font-weight: 300;
    }

    .ticket-num.generated {
      background-color: var(--accent-glow);
      color: var(--accent-color);
      border-color: var(--accent-color);
      box-shadow: 0 0 8px var(--accent-glow);
      transform: scale(1.05);
    }

    .ticket-legend {
      display: flex;
      gap: 16px;
      font-size: 12px;
      color: var(--text-secondary);
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .legend-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
    }

    .legend-dot.normal { background-color: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); }
    .legend-dot.fixed { background-color: var(--accent-color); }
    .legend-dot.excluded { background-color: #ef4444; }
    .legend-dot.generated { background-color: var(--accent-glow); border: 1px solid var(--accent-color); }

    /* Action Buttons */
    .btn {
      background-color: var(--accent-color);
      color: #ffffff;
      border: none;
      border-radius: var(--radius-md);
      padding: 12px 24px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all var(--transition-speed) ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 4px 12px var(--accent-glow);
      text-decoration: none;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px var(--accent-glow);
      filter: brightness(1.1);
    }

    .btn:active {
      transform: translateY(0);
    }

    .btn-secondary {
      background-color: rgba(255, 255, 255, 0.05);
      border: 1px solid var(--border-color);
      color: var(--text-primary);
      box-shadow: none;
    }

    .btn-secondary:hover {
      background-color: rgba(255, 255, 255, 0.08);
      border-color: var(--border-color-active);
      box-shadow: none;
    }

    .btn-group {
      display: flex;
      gap: 12px;
    }

    /* Result list */
    .games-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
      max-height: 500px;
      overflow-y: auto;
      padding-right: 6px;
    }

    .game-card {
      background-color: rgba(255,255,255,0.01);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-md);
      padding: 14px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.2s;
    }

    .game-card:hover {
      background-color: rgba(255,255,255,0.03);
      border-color: var(--border-color-active);
      transform: translateX(4px);
    }

    .game-num-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .game-index {
      font-size: 12px;
      color: var(--text-muted);
      font-weight: 700;
      background-color: rgba(0,0,0,0.2);
      padding: 2px 6px;
      border-radius: 4px;
    }

    .game-balls {
      display: flex;
      gap: 6px;
    }

    .game-stats {
      font-size: 11px;
      color: var(--text-muted);
      display: flex;
      gap: 12px;
      background-color: rgba(0,0,0,0.15);
      padding: 6px 12px;
      border-radius: 6px;
    }

    .game-stats span b {
      color: var(--text-secondary);
    }

    /* Tables */
    .table-container {
      overflow-x: auto;
      max-height: 500px;
      border-radius: var(--radius-md);
      border: 1px solid var(--border-color);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 13px;
    }

    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid var(--border-color);
    }

    th {
      background-color: rgba(0,0,0,0.2);
      color: var(--text-secondary);
      font-weight: 600;
      cursor: pointer;
      user-select: none;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    th:hover {
      color: var(--text-primary);
    }

    tr:hover {
      background-color: rgba(255,255,255,0.02);
    }

    /* Interactive Heatmap page */
    .heatmap-grid {
      display: grid;
      gap: 4px;
      padding: 16px;
      background-color: rgba(0,0,0,0.2);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border-color);
    }

    .heatmap-cell {
      height: 44px;
      border-radius: 6px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      border: 1px solid rgba(255,255,255,0.03);
    }

    .heatmap-cell span:last-child {
      font-size: 9px;
      font-weight: 400;
      opacity: 0.7;
    }

    /* Distribution Charts */
    .chart-container {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .chart-row {
      display: flex;
      align-items: center;
      gap: 16px;
      font-size: 13px;
    }

    .chart-label {
      width: 140px;
      flex-shrink: 0;
      color: var(--text-secondary);
      font-weight: 500;
      white-space: nowrap;
    }

    .chart-bar-bg {
      flex: 1;
      height: 16px;
      background-color: rgba(255,255,255,0.03);
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid var(--border-color);
    }

    .chart-bar-fill {
      height: 100%;
      background-color: var(--accent-color);
      box-shadow: 0 0 10px var(--accent-glow);
      border-radius: 8px;
      transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .chart-value {
      width: 48px;
      text-align: right;
      font-weight: 600;
    }

    /* Footer styling */
    footer {
      margin-top: auto;
      padding: 24px 32px;
      border-top: 1px solid var(--border-color);
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      color: var(--text-muted);
    }

    footer a {
      color: var(--text-secondary);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    footer a:hover {
      color: var(--accent-color);
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Modal dialog */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.7);
      backdrop-filter: blur(4px);
      z-index: 100;
      display: none;
      align-items: center;
      justify-content: center;
    }

    .modal {
      background-color: var(--bg-secondary);
      border: 1px solid var(--border-color-active);
      border-radius: var(--radius-lg);
      padding: 28px;
      max-width: 500px;
      width: 90%;
      box-shadow: 0 20px 40px rgba(0,0,0,0.6);
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .modal-header {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: var(--text-primary);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-close {
      cursor: pointer;
      color: var(--text-muted);
      font-size: 24px;
    }

    .modal-close:hover {
      color: var(--text-primary);
    }

    .modal-body {
      font-size: 14px;
      line-height: 1.6;
      color: var(--text-secondary);
    }

    .modal-body b {
      color: var(--text-primary);
    }

    /* RESPONSIVE DESIGN - MOBILE & TABLET */
    @media (max-width: 991px) {
      .app-container {
        flex-direction: column;
      }

      /* Mobile Header Top Bar */
      .mobile-nav-header {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        background-color: var(--bg-secondary);
        border-bottom: 1px solid var(--border-color);
        position: sticky;
        top: 0;
        z-index: 999;
        width: 100%;
        height: 60px;
        box-sizing: border-box;
      }

      .mobile-menu-btn {
        background: transparent;
        border: none;
        color: var(--text-primary);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        border-radius: var(--radius-sm);
        transition: background-color var(--transition-speed);
      }

      .mobile-menu-btn:hover {
        background-color: rgba(255, 255, 255, 0.05);
      }

      .mobile-menu-btn svg {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
      }

      .mobile-logo-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 18px;
        letter-spacing: -0.5px;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 6px;
      }

      .mobile-logo-text span {
        color: var(--accent-color);
      }

      /* Sliding Sidebar Drawer */
      .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        z-index: 1001;
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow-y: auto;
        box-shadow: 10px 0 30px rgba(0, 0, 0, 0.6);
        background-color: var(--bg-secondary);
        border-right: 1px solid var(--border-color);
      }

      .sidebar.active {
        transform: translateX(0);
      }

      /* Sidebar Overlay */
      .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1000;
      }

      .sidebar-overlay.active {
        display: block;
      }

      /* Main Content Area */
      .main-content {
        padding: 16px;
        gap: 20px;
        max-height: none;
        overflow-y: visible;
      }

      /* Topbar adjustments */
      .topbar {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
        padding: 16px;
      }

      .topbar-info {
        justify-content: space-between;
        width: 100%;
      }

      .topbar-meta {
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        width: 100%;
      }

      .meta-item {
        text-align: center;
        padding: 8px;
        background-color: rgba(255, 255, 255, 0.02);
        border-radius: var(--radius-sm);
        border: 1px solid var(--border-color);
      }

      /* Grid / Layout adjustments */
      .grid-dashboard, .grid-2col, .generator-layout {
        grid-template-columns: 1fr !important;
        gap: 16px;
      }

      /* Table responsive wrap */
      .table-container {
        overflow-x: auto;
      }
    }

    @media (max-width: 480px) {
      .chart-label {
        width: 100px;
        font-size: 11px;
      }
      .chart-value {
        width: 40px;
        font-size: 11px;
      }
      .topbar-info h2 {
        font-size: 18px;
      }
      .topbar-meta {
        grid-template-columns: 1fr;
      }
      .meta-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 12px;
      }
      .ball {
        width: 40px;
        height: 40px;
        font-size: 15px;
      }
      .ticket-grid {
        gap: 4px !important;
      }
      .ticket-num {
        height: 36px !important;
        font-size: 13px !important;
      }
    }
  </style>

    <!-- 4u-Labs SEO & Standard Meta -->
    <meta name="description" content="Central das Loterias ✦ Super App de Análise &amp; Palpites — Aplicativo Web gratuito da 4u-Labs em 4u.ia.br.">
    <link rel="canonical" href="https://4u.ia.br/app/loterias/">
    <meta property="og:type" content="website"><meta property="og:site_name" content="4u-Labs"><meta property="og:url" content="https://4u.ia.br/app/loterias/"><meta property="og:title" content="Central das Loterias ✦ Super App de Análise &amp; Palpites"><meta property="og:description" content="Central das Loterias ✦ Super App de Análise &amp; Palpites — Aplicativo Web gratuito da 4u-Labs em 4u.ia.br."><meta property="og:image" content="https://4u.ia.br/capa.webp">
</head>
<body class="theme-megasena">
  <!-- Mobile Navigation Header -->
  <div class="mobile-nav-header" style="display: none;">
    <button class="mobile-menu-btn" onclick="toggleMobileSidebar(true)">
      <svg viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </button>
    <div class="mobile-logo-text">
      <span>✦</span> Super Loterias
    </div>
    <div style="width: 40px;"></div>
  </div>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleMobileSidebar(false)"></div>

  <div class="app-container">
    
    <!-- Sidebar -->
    <aside class="sidebar">
      <a href="#" class="brand" id="logo-link">
        <div class="brand-logo">
          <span>✦</span> Super Loterias
        </div>
        <div class="brand-subtitle">Análise & Palpites</div>
      </a>

      <nav class="nav-menu">
        <div class="nav-item active" onclick="switchPage('dashboard')">
          <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
          Dashboard
        </div>
        <div class="nav-item" onclick="switchPage('generator')">
          <svg viewBox="0 0 24 24"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          Gerador Inteligente
        </div>
        <div class="nav-item" onclick="switchPage('stats')">
          <svg viewBox="0 0 24 24"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
          Estatísticas
        </div>
        <div class="nav-item" onclick="switchPage('history')">
          <svg viewBox="0 0 24 24"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg>
          Resultados & Busca
        </div>
        <div class="nav-item" onclick="showTutorialModal()">
          <svg viewBox="0 0 24 24" style="fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20M4 19.5V3a2.5 2.5 0 0 1 2.5-2.5H20v16.5H6.5a2.5 2.5 0 0 0-2.5 2.5z"/></svg>
          Tutorial & Ciência
        </div>
        <div class="nav-item" onclick="switchPage('bolao')">
          <svg viewBox="0 0 24 24" style="fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 7a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm14 14v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          Simulador de Bolão
        </div>

        <div class="nav-item" id="pwa-install-nav" style="display: none;" onclick="triggerPwaInstall()">
          <svg viewBox="0 0 24 24" style="fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
          Instalar Aplicativo
        </div>
      </nav>

      <div>
        <div class="lottery-selector-title">Escolher Loteria</div>
        <div class="lottery-grid">
          <button class="lottery-btn active" id="btn-megasena" onclick="selectLottery('megasena')">
            Mega-Sena <span class="lottery-badge">60N</span>
          </button>
          <button class="lottery-btn" id="btn-lotofacil" onclick="selectLottery('lotofacil')">
            Lotofácil <span class="lottery-badge">25N</span>
          </button>
          <button class="lottery-btn" id="btn-quina" onclick="selectLottery('quina')">
            Quina <span class="lottery-badge">80N</span>
          </button>
          <button class="lottery-btn" id="btn-lotomania" onclick="selectLottery('lotomania')">
            Lotomania <span class="lottery-badge">100N</span>
          </button>
          <button class="lottery-btn" id="btn-duplasena" onclick="selectLottery('duplasena')">
            Dupla Sena <span class="lottery-badge">50N</span>
          </button>
          <button class="lottery-btn" id="btn-timemania" onclick="selectLottery('timemania')">
            Timemania <span class="lottery-badge">80N</span>
          </button>
        </div>
        
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      
      <!-- Topbar -->
      <header class="topbar">
        <div class="topbar-info" style="display: flex; align-items: center; gap: 16px;">
          <h2 id="lottery-header-name"><span>Mega-Sena</span> Analisador</h2>
          <button id="btn-update-results" class="btn" style="padding: 6px 12px; font-size: 11px; font-weight: 600; display: flex; align-items: center; gap: 6px; background-color: var(--accent-glow); border: 1px solid var(--accent-color); color: var(--accent-color); box-shadow: none;" onclick="triggerOnlineUpdate()">
            <svg viewBox="0 0 24 24" style="width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
            Atualizar Resultados
          </button>
        </div>
        <div class="topbar-meta">
          <div class="meta-item">
            <span class="meta-label">Último Concurso</span>
            <span class="meta-value" id="topbar-last-contest">3018</span>
          </div>
          <div class="meta-item">
            <span class="meta-label">Data</span>
            <span class="meta-value" id="topbar-last-date">13/06/2026</span>
          </div>
          <div class="meta-item">
            <span class="meta-label">Total Concursos</span>
            <span class="meta-value" id="topbar-total-draws">3018</span>
          </div>
        </div>
      </header>

      <!-- PAGE 1: DASHBOARD -->
      <section id="page-dashboard" class="page-view active">
        <div class="grid-dashboard">
          
          <div style="display: flex; flex-direction: column; gap: 24px;">
            <!-- Latest Draw Panel -->
            <div class="panel">
              <div class="panel-title">
                Último Concurso Sorteado
                <span id="dash-draw-badge" style="font-size: 11px; background-color: var(--accent-glow); color: var(--accent-color); padding: 4px 8px; border-radius: 6px;">Conc. 3018</span>
              </div>
              <div style="display: flex; flex-direction: column; gap: 12px;">
                <div class="draw-balls-container" id="dash-draw-balls">
                  <!-- Generated dynamic balls -->
                </div>
                <div class="topbar-meta" style="margin-top: 8px;">
                  <div class="meta-item">
                    <span class="meta-label">Ímpares / Pares</span>
                    <span class="meta-value" id="dash-even-odd-split">3 Impar / 3 Par</span>
                  </div>
                  <div class="meta-item">
                    <span class="meta-label">Altos / Baixos</span>
                    <span class="meta-value" id="dash-high-low-split">2 Alto / 4 Baixo</span>
                  </div>
                  <div class="meta-item">
                    <span class="meta-label">Soma dos Números</span>
                    <span class="meta-value" id="dash-numbers-sum">164</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Smart Suggestion Panel -->
            <div class="panel">
              <div class="panel-title">Palpite Sugerido por Inteligência Estatística</div>
              <div style="display: flex; flex-direction: column; gap: 16px;">
                <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.5;">
                  Este palpite foi gerado balanceando os números com maior frequência de sorteio (Quentes), números mais atrasados e médias históricas de pares/ímpares e altos/baixos.
                </p>
                <div class="draw-balls-container" id="smart-suggestion-balls">
                  <!-- Suggested balls -->
                </div>
                <div style="display: flex; gap: 12px; margin-top: 8px;">
                  <button class="btn" onclick="sendSuggestionToGenerator()">Usar no Gerador</button>
                  <button class="btn btn-secondary" onclick="generateNewSmartSuggestion()">Outra Sugestão</button>
                </div>
              </div>
            </div>
          </div>

          <div style="display: flex; flex-direction: column; gap: 24px;">
            <!-- Fast Analytics Panel -->
            <div class="panel">
              <div class="panel-title">Resumo Analítico</div>
              <div style="display: flex; flex-direction: column; gap: 12px;">
                <div class="stat-row">
                  <span>Mais Sorteados (Quentes)</span>
                  <span id="dash-hot-nums" style="font-family: monospace; font-size: 14px; font-weight: 700; color: var(--accent-color);">10, 05, 54, 23...</span>
                </div>
                <div class="stat-row">
                  <span>Mais Atrasados (Frios)</span>
                  <span id="dash-cold-nums" style="font-family: monospace; font-size: 14px; font-weight: 700; color: #ef4444;">12, 19, 41...</span>
                </div>
                <div class="stat-row">
                  <span>Proporção Geral Altos</span>
                  <span id="dash-high-pct">51.2%</span>
                </div>
                <div class="stat-row">
                  <span>Proporção Geral Baixos</span>
                  <span id="dash-low-pct">48.8%</span>
                </div>
              </div>
            </div>
            
            <!-- Information Panel -->
            <div class="panel">
              <div class="panel-title">Dica do Especialista</div>
              <div style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; display: flex; flex-direction: column; gap: 10px;">
                <p>
                  <b>1. Evite extremos:</b> Jogar apenas números quentes ou apenas números frios reduz suas chances. O equilíbrio (60/30/10) é o ideal.
                </p>
                <p>
                  <b>2. Distribua nos quadrantes:</b> Tente espalhar seus números de forma homogênea pela cartela. Evite agrupar mais de 3 números adjacentes.
                </p>
                <p>
                  <a href="#" onclick="showDicasModal(); return false;" style="color: var(--accent-color); font-weight: 600; text-decoration: none;">Ver Guia de Probabilidades →</a>
                </p>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- PAGE 2: GENERATOR -->
      <section id="page-generator" class="page-view">
        <div class="generator-layout">
          
          <!-- Configurations -->
          <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="panel">
              <div class="panel-title">Parâmetros</div>
              
              <div class="form-group">
                <label for="gen-mode">Modo de Jogo</label>
                <select id="gen-mode" class="form-select" onchange="toggleGeneratorMode()">
                  <option value="stats" selected>Surpresinha / Estatístico</option>
                  <option value="fechamento">Fechamento Matemático</option>
                </select>
              </div>

              <!-- STATS MODE FIELDS -->
              <div id="gen-stats-fields" style="display: flex; flex-direction: column; gap: 20px;">
                <div class="form-group">
                  <label for="gen-num-count">Dezenas por Jogo</label>
                  <select id="gen-num-count" class="form-select" onchange="validateFormInput()">
                    <!-- Options filled via JS -->
                  </select>
                </div>

                <div class="form-group">
                  <label for="gen-ticket-count">Quantidade de Jogos</label>
                  <input id="gen-ticket-count" type="number" min="1" max="100" value="5" class="form-input">
                </div>

                <div class="form-group">
                  <label for="gen-strategy">Estratégia</label>
                  <select id="gen-strategy" class="form-select">
                    <option value="balanced" selected>Balanceado (Estatístico)</option>
                    <option value="hot">Tendência Quente (Mais Frequentes)</option>
                    <option value="cold">Tendência Fria (Mais Atrasados)</option>
                    <option value="random">Aleatório (Surpresinha)</option>
                  </select>
                </div>
              </div>

              <!-- FECHAMENTO MODE FIELDS -->
              <div id="gen-fechamento-fields" style="display: none; flex-direction: column; gap: 20px;">
                <div class="form-group">
                  <label for="gen-fechamento-template">Template de Fechamento</label>
                  <select id="gen-fechamento-template" class="form-select" onchange="onSelectFechamentoTemplate()">
                    <!-- Filled dynamically -->
                  </select>
                </div>
                <div id="fechamento-info-box" style="font-size: 12px; color: var(--text-secondary); line-height: 1.5; background-color: rgba(0,0,0,0.15); padding: 12px; border-radius: 8px; border: 1px solid var(--border-color);">
                  <!-- Dynamic info -->
                </div>
              </div>

              <button class="btn" id="btn-generate-palpites" style="width: 100%; margin-top: 10px;" onclick="triggerGeneration()">Gerar Jogos</button>
            </div>
            
            <div class="panel">
              <div class="panel-title">Fixos & Proibidos</div>
              <div style="font-size: 12px; color: var(--text-secondary); line-height: 1.5; display: flex; flex-direction: column; gap: 8px;">
                <p>Use o painel ao lado para selecionar os números que você <b>quer forçar</b> ou <b>quer bloquear</b>.</p>
                <div style="display: flex; justify-content: space-between; margin-top: 8px;">
                  <span id="count-fixed" style="color: var(--accent-color); font-weight: 600;">0 Fixados</span>
                  <span id="count-excluded" style="color: #ef4444; font-weight: 600;">0 Excluídos</span>
                </div>
                <button class="btn btn-secondary" style="padding: 8px 12px; font-size: 11px;" onclick="clearFilters()">Limpar Filtros</button>
              </div>
            </div>
          </div>

          <!-- Ticket Grid and Results -->
          <div style="display: flex; flex-direction: column; gap: 24px;">
            <div class="grid-2col">
              
              <div class="panel">
                <div class="panel-title">Cartela Interativa</div>
                <div class="ticket-grid-container">
                  <div class="ticket-grid" id="ticket-grid">
                    <!-- Numbers filled by JS -->
                  </div>
                  <div class="ticket-legend">
                    <div class="legend-item"><div class="legend-dot normal"></div> Padrão</div>
                    <div class="legend-item"><div class="legend-dot fixed"></div> Fixo</div>
                    <div class="legend-item"><div class="legend-dot excluded"></div> Proibido</div>
                    <div class="legend-item"><div class="legend-dot generated"></div> Gerado</div>
                  </div>
                </div>
              </div>

              <div class="panel">
                <div class="panel-title">
                  Jogos Gerados
                  <div style="display: flex; gap: 8px; align-items: center;">
                    <span id="gen-results-count" style="font-size: 11px; background-color: var(--border-color); color: var(--text-secondary); padding: 4px 8px; border-radius: 6px;">0 Jogos</span>
                    <span id="gen-results-cost" style="font-size: 11px; background-color: var(--accent-glow); color: var(--accent-color); padding: 4px 8px; border-radius: 6px; display: none;">R$ 0,00</span>
                  </div>
                </div>
                
                <div class="games-list" id="generated-games-container">
                  <div style="text-align: center; padding: 48px 0; color: var(--text-muted); font-size: 13px;">
                    Nenhum jogo gerado. Configure os parâmetros e clique em "Gerar Palpites".
                  </div>
                </div>

                <div class="btn-group" id="generator-actions" style="display: none; margin-top: 12px; gap: 8px;">
                   <button class="btn btn-secondary" style="flex: 1;" onclick="exportTXT()">TXT</button>
                   <button class="btn btn-secondary" style="flex: 1;" onclick="exportCSV()">CSV</button>
                   <button class="btn btn-secondary" style="flex: 1.2; display: flex; align-items: center; justify-content: center; gap: 6px; background-color: #20ab6e; color: #fff; border-color: #20ab6e;" onclick="shareWhatsApp()">
                     <svg viewBox="0 0 24 24" style="width: 14px; height: 14px; fill: currentColor;"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.725 1.451 5.485.002 9.948-4.463 9.95-9.952.002-2.659-1.03-5.161-2.909-7.04C16.536 1.774 14.04 1.74 11.986 1.74c-5.486 0-9.95 4.464-9.952 9.953-.001 1.77.491 3.5 1.42 5.03l-.997 3.642 3.79-.993zm11.233-6.732c-.08-.135-.294-.216-.614-.377-.32-.16-1.89-.93-2.185-1.037-.295-.108-.51-.16-.724.162-.215.323-.83 1.037-1.018 1.252-.187.215-.376.242-.696.082-.32-.16-1.353-.499-2.577-1.59-1.026-.915-1.554-1.921-1.755-2.26-.2-.339-.022-.523.138-.683.144-.144.32-.377.48-.565.16-.188.214-.323.32-.539.106-.215.053-.404-.027-.565-.08-.16-.724-1.748-.992-2.395-.262-.63-.53-.54-.724-.55-.188-.01-.403-.012-.618-.012-.215 0-.564.08-.86.404-.295.323-1.127 1.102-1.127 2.69 0 1.59 1.155 3.12 1.316 3.337.16.215 2.274 3.473 5.509 4.872.77.332 1.37.531 1.838.68.775.246 1.48.212 2.038.129.622-.093 1.89-.773 2.158-1.482.268-.708.268-1.317.188-1.482z"/></svg>
                     WhatsApp
                   </button>
                   <button class="btn" style="flex: 1.8;" onclick="checkGeneratedGames()">Testar Histórico</button>
                 </div>
              </div>

            </div>
          </div>

        </div>
      </section>

      <!-- PAGE 3: STATISTICS -->
      <section id="page-stats" class="page-view">
        <div class="grid-2col">
          
          <!-- Charts and Summary -->
          <div style="display: flex; flex-direction: column; gap: 24px;">
            <div class="panel">
              <div class="panel-title">Distribuição de Frequência de Pares vs Ímpares</div>
              <div class="chart-container" id="even-odd-chart">
                <!-- Filled by JS -->
              </div>
            </div>

            <div class="panel">
              <div class="panel-title">Proporção Geral de Números Altos / Baixos</div>
              <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; justify-content: space-between; font-size: 13px; color: var(--text-secondary);">
                  <span>Baixos (Primeira Metade)</span>
                  <span>Altos (Segunda Metade)</span>
                </div>
                <div class="chart-bar-bg" style="height: 24px;">
                  <div class="chart-bar-fill" id="high-low-bar-low" style="background-color: var(--accent-color); float: left; width: 50%;"></div>
                  <div class="chart-bar-fill" id="high-low-bar-high" style="background-color: #3b82f6; float: right; width: 50%;"></div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 700;">
                  <span id="low-pct-text">50.0%</span>
                  <span id="high-pct-text">50.0%</span>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-title">Distribuição por Quadrantes (Geral)</div>
              <div class="chart-container" id="quadrant-chart" style="display: flex; flex-direction: column; gap: 12px;">
                <!-- Filled by JS -->
              </div>
            </div>

            <div class="panel">
              <div class="panel-title">Distribuição de Números Primos por Sorteio</div>
              <div class="chart-container" id="prime-chart">
                <!-- Filled by JS -->
              </div>
            </div>
          </div>

          <!-- Frequency Table -->
          <div style="display: flex; flex-direction: column; gap: 24px;">
            <div class="panel">
              <div class="panel-title">
                Tabela de Frequência das Dezenas
                <input type="text" id="stats-search" placeholder="Filtrar número..." class="form-input" style="width: 150px; padding: 6px 12px; font-size: 12px;" oninput="filterStatsTable()">
              </div>
              <div class="table-container">
                <table id="stats-table">
                  <thead>
                    <tr>
                      <th onclick="sortTable(0)">Número ⇅</th>
                      <th onclick="sortTable(1)">Sorteios (Freq) ⇅</th>
                      <th onclick="sortTable(2)">Frequência (%) ⇅</th>
                      <th onclick="sortTable(3)">Atraso (Conc.) ⇅</th>
                    </tr>
                  </thead>
                  <tbody id="stats-table-body">
                    <!-- Loaded dynamically via JS -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- PAGE 4: HISTORY & SIMULATOR -->
      <section id="page-history" class="page-view">
        <div class="grid-2col">
          
          <!-- Recent Draws -->
          <div class="panel">
            <div class="panel-title">Histórico de Últimos Sorteios</div>
            <div class="games-list" id="history-draws-container" style="max-height: 520px;">
              <!-- Filled by JS -->
            </div>
          </div>

          <!-- Simulator -->
          <div class="panel">
            <div class="panel-title">Simulador de Jogos Passados</div>
            <div style="display: flex; flex-direction: column; gap: 20px;">
              <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.5;">
                Digite seu jogo abaixo para testar se ele já obteve alguma premiação no histórico desta loteria.
              </p>
              
              <div class="form-group">
                <label for="sim-input" id="sim-input-label">Dezenas do seu jogo (separadas por vírgula)</label>
                <input id="sim-input" type="text" placeholder="Ex: 5, 12, 23, 34, 45, 56" class="form-input">
              </div>

              <button class="btn" onclick="simulateGameHistory()">Simular Jogo</button>
              
              <div id="sim-results" style="display: none; flex-direction: column; gap: 16px;">
                <div class="stat-row" style="background-color: var(--accent-glow); border-color: var(--accent-color);">
                  <span style="color: var(--text-primary);">Maior Acerto no Histórico</span>
                  <span id="sim-max-hits" style="font-size: 16px; font-weight: 700;">-</span>
                </div>
                
                <div id="sim-success-breakdown" style="display: flex; flex-direction: column; gap: 8px;">
                  <!-- Hits summary -->
                </div>

                <div class="table-container" style="max-height: 200px;">
                  <table>
                    <thead>
                      <tr>
                        <th>Concurso</th>
                        <th>Data</th>
                        <th>Acertos</th>
                        <th>Sorteado</th>
                      </tr>
                    </thead>
                    <tbody id="sim-table-body">
                      <!-- Results matches list -->
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>

        </div>
      </section>

       <!-- PAGE 5: SYNDICATE CALCULATOR -->
       <section id="page-bolao" class="page-view">
         <div class="grid-2col">
           
           <!-- Bolao inputs -->
           <div class="panel">
             <div class="panel-title">Simulador & Calculadora de Bolão</div>
             <div style="display: flex; flex-direction: column; gap: 20px;">
               <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.5;">
                 Calcule a divisão de custos, taxas organizacionais e prêmios estimados de bolões entre amigos de forma exata.
               </p>
               
               <div class="form-group">
                 <label for="bolao-game-count">Quantidade de Jogos no Bolão</label>
                 <input id="bolao-game-count" type="number" min="1" value="10" class="form-input" oninput="updateBolaoCalculations()">
               </div>
               
               <div class="form-group">
                 <label for="bolao-custom-total">Valor Total das Apostas (R$) <span style="font-size: 11px; color: var(--text-muted); font-weight: normal;">(Opcional - sobrescreve o cálculo automático)</span></label>
                 <input id="bolao-custom-total" type="text" placeholder="Ex: 50,00" class="form-input" oninput="formatCurrencyInput(this); updateBolaoCalculations()">
               </div>
               
               <div class="form-group">
                 <label for="bolao-shares">Número de Cotas (Participantes)</label>
                 <input id="bolao-shares" type="number" min="1" value="10" class="form-input" oninput="updateBolaoCalculations()">
               </div>
               
               <div class="form-group">
                 <label for="bolao-fee">Taxa de Organização / Administração (%)</label>
                 <input id="bolao-fee" type="number" min="0" max="100" value="10" class="form-input" oninput="updateBolaoCalculations()">
               </div>
               
               <div class="form-group">
                 <label for="bolao-estimated-prize">Valor Estimado do Prêmio Principal (R$)</label>
                 <input id="bolao-estimated-prize" type="text" value="45.000.000,00" class="form-input" oninput="formatCurrencyInput(this); updateBolaoCalculations()">
               </div>
             </div>
           </div>
           
           <!-- Bolao results -->
           <div class="panel" style="justify-content: space-between;">
             <div class="panel-title">Detalhamento Financeiro do Bolão</div>
             
             <div style="display: flex; flex-direction: column; gap: 16px;">
               <div class="stat-row">
                 <span>Custo Unitário do Jogo (Caixa)</span>
                 <span id="bolao-res-unit-cost">R$ 5,00</span>
               </div>
               <div class="stat-row">
                 <span>Custo dos Jogos Oficiais</span>
                 <span id="bolao-res-official-cost">R$ 50,00</span>
               </div>
               <div class="stat-row">
                 <span>Taxa do Organizador</span>
                 <span id="bolao-res-fee-val">R$ 5,00</span>
               </div>
               <div class="stat-row" style="background-color: var(--accent-glow); border-color: var(--accent-color);">
                 <span style="color: var(--text-primary); font-weight: 600;">Custo Total do Bolão</span>
                 <span id="bolao-res-total-cost" style="font-size: 16px; font-weight: 700; color: var(--accent-color);">R$ 55,00</span>
               </div>
               <div class="stat-row" style="background-color: rgba(255, 255, 255, 0.02); border-color: var(--border-color-active);">
                 <span style="color: var(--text-primary); font-weight: 600;">Valor por Cota (Participante)</span>
                 <span id="bolao-res-share-cost" style="font-size: 16px; font-weight: 700; color: var(--text-primary);">R$ 5,50</span>
               </div>
               <div class="stat-row">
                 <span>Prêmio Principal por Cota</span>
                 <span id="bolao-res-share-prize" style="font-weight: 700; color: #eab308;">R$ 4.500.000,00</span>
               </div>
             </div>

             <div style="font-size: 12px; color: var(--text-secondary); line-height: 1.6; border-top: 1px solid var(--border-color); padding-top: 16px; margin-top: 16px;">
               <p id="bolao-summary-text">
                 Este bolão é composto por 10 cotas. O organizador receberá uma taxa de 10% pelo serviço de registro das dezenas.
               </p>
             </div>
           </div>

         </div>
       </section>

      <!-- Footer -->
      <footer>
        <div style="display: flex; flex-direction: column; gap: 4px;">
          <div>&copy; 2026 Super Loterias. Todos os direitos reservados.</div>
          <div style="font-size: 11px; color: var(--text-muted); font-weight: 500;">
            Base de inteligência: 22.085 concursos oficiais analisados e 220.172 dezenas históricas processadas (1994 - 2026).
          </div>
        </div>
        <div>
          Feito por <a href="https://4u.ia.br/#contact" target="_blank">4u.ia.br</a>
        </div>
      </footer>

    </main>

  </div>

  <!-- Modal Dicas -->
  <div class="modal-overlay" id="dicas-modal">
    <div class="modal">
      <div class="modal-header">
        Guias de Estatística Aplicada
        <span class="modal-close" onclick="closeDicasModal()">&times;</span>
      </div>
      <div class="modal-body">
        <p style="margin-bottom: 12px;">Para aumentar a probabilidade matemática nos seus jogos, siga as regras de ouro:</p>
        <ul style="padding-left: 20px; margin-bottom: 16px; display: flex; flex-direction: column; gap: 8px;">
          <li><b>Proporção Par/Ímpar:</b> ~80% dos concursos sorteados têm proporção balanceada de dezenas pares e ímpares (ex: 3P:3I na Mega-Sena).</li>
          <li><b>Metades (Altos/Baixos):</b> Escolha metade dos seus números na parte inferior da cartela (1-30 na Mega) e metade na parte superior (31-60).</li>
          <li><b>Soma dos Números:</b> A soma das dezenas de um cartão Mega-Sena de 6 dezenas geralmente fica entre 150 e 220. Descarte cartões com somas muito baixas ou altas.</li>
          <li><b>Não repita padrões simples:</b> Jogos seguidos (1, 2, 3, 4, 5, 6) ou apenas finais iguais (12, 22, 32, 42, 52) nunca foram sorteados.</li>
        </ul>
        <p style="font-size: 12px; color: var(--text-muted);">
          *Atenção: A loteria é um jogo de azar. As análises estatísticas mostram tendências do passado e não garantem ganhos futuros, mas ajudam a eliminar jogos ruins.
        </p>
      </div>
    </div>
  </div>

  <!-- Modal Tutorial -->
  <div class="modal-overlay" id="tutorial-modal" style="display: none;">
    <div class="modal" style="max-width: 750px; width: 90%;">
      <div class="modal-header">
        Tutorial do Aplicativo & Fundamentação Científica
        <span class="modal-close" onclick="closeTutorialModal()">&times;</span>
      </div>
      
      <!-- Tab Header Navigation -->
      <div style="display: flex; gap: 8px; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
        <button id="tab-btn-guia" class="btn" style="padding: 8px 16px; font-size: 13px; font-weight: 600; background-color: var(--accent-color); color: #fff; box-shadow: none;" onclick="switchTutorialTab('guia')">
          1. Guia do Aplicativo (Como Jogar)
        </button>
        <button id="tab-btn-ciencia" class="btn" style="padding: 8px 16px; font-size: 13px; font-weight: 600; background-color: transparent; border: 1px solid var(--border-color); color: var(--text-secondary); box-shadow: none;" onclick="switchTutorialTab('ciencia')">
          2. Base Científica (Estatística & Matemática)
        </button>
      </div>
      
      <div class="modal-body" style="max-height: 480px; overflow-y: auto; padding-right: 8px;">
        
        <!-- Tab Content 1: Guia do Aplicativo -->
        <div id="tutorial-tab-guia">
          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">✦ Painel de Dashboard (Análise Rápida)</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
            No Dashboard você visualiza a análise do **último concurso sorteado pela Caixa** (distribuição par/ímpar, altos/baixos e a soma das dezenas). Logo abaixo, o sistema gera automaticamente um <b>Palpite Inteligente</b> baseado no cruzamento das dezenas mais quentes e frias da loteria atual.
          </p>
          
          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">✦ Volante Interativo (Fixar e Proibir Números)</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
            Na cartela/volante interativo, você pode selecionar números manualmente clicando sobre eles:
            <br>• <b style="color: var(--accent-color);">Verde (Fixo):</b> A dezena é obrigatória em todos os jogos gerados.
            <br>• <b style="color: #ef4444;">Vermelho (Proibido):</b> A dezena é excluída e nunca aparecerá em seus jogos.
            <br>• <b>Cinza (Livre):</b> Dezenas normais que podem ou não ser selecionadas estatisticamente.
          </p>

          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">✦ Gerador Inteligente</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
            Escolha o método <b>Surpresinha Estatística</b>, defina quantos cartões quer gerar e escolha sua estratégia:
            <br>• <b>Balanceado:</b> Mistura dezenas quentes, frias e neutras na proporção ideal de sorteio.
            <br>• <b>Super Quentes:</b> Foca apenas nas dezenas mais sorteadas historicamente.
            <br>• <b>Mais Atrasados:</b> Foca nas dezenas com maior atraso (frias), que estão propensas a sair.
            <br>• <b>Aleatório:</b> Geração clássica (surpresinha comum).
          </p>

          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">✦ Fechamentos Matemáticos (Desdobramentos)</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
            Os fechamentos combinatórios servem para garantir premiações menores (Quadra, Quina, etc.) caso você acerte as dezenas sorteadas dentro de um grupo que você escolheu. O aplicativo calcula em tempo real o **menor número de bilhetes necessários** para obter a garantia selecionada, poupando seu dinheiro!
          </p>

          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">✦ Simulador de Histórico</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 8px;">
            Digite suas dezenas e teste o desempenho contra todos os concursos históricos da Caixa. O simulador calcula quantos acertos você teria feito em cada concurso passado.
          </p>
        </div>
        
        <!-- Tab Content 2: Base Científica -->
        <div id="tutorial-tab-ciencia" style="display: none;">
          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">🔬 A Lei dos Grandes Números</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
            Em probabilidade, a **Lei dos Grandes Números** afirma que quanto maior o número de sorteios, mais a frequência acumulada se aproxima da probabilidade matemática teórica real. Com mais de 22.000 sorteios consolidados neste app, identificamos padrões claros de estabilização matemática.
          </p>

          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">📊 Distribuição Par / Ímpar</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
            Matematicamente, em um sorteio como a Mega-Sena (6 dezenas), a chance de sortearem apenas números Pares ou apenas Ímpares é de apenas <b>1,5%</b>. Por outro lado, a proporção balanceada de **3 Pares e 3 Ímpares ocorre em mais de 30% dos sorteios**. O gerador inteligente aplica esta barreira estatística para descartar jogos ruins.
          </p>

          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">📈 Curva de Gauss (Soma das Dezenas)</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 16px;">
            A soma das dezenas sorteadas segue uma **Distribuição Normal (Sino de Gauss)**. Para a Mega-Sena, a soma média teórica é 183. Cerca de 70% de todos os concursos têm somas que caem exclusivamente entre **150 e 220**. Jogar cartões fora dessa faixa central reduz drasticamente suas chances.
          </p>

          <h3 style="color: var(--accent-color); font-size: 16px; margin-bottom: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">🧮 Teoria de Cobertura de Conjuntos (Set Covering)</h3>
          <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 8px;">
            Para os Fechamentos Matemáticos, o cérebro em PHP do aplicativo utiliza um resolvedor de <b>Set Covering (Cobertura de Conjuntos)</b> através de uma aproximação gulosa (<i>greedy algorithm</i>). Ele otimiza a seleção combinatória de bilhetes para cobrir todas as sub-combinações garantidas utilizando a menor quantidade de jogos possíveis, reduzindo o custo da aposta de forma matemática.
          </p>
        </div>
        
      </div>
    </div>
  </div>

  <script>
    // Embedded Lottery Statistics Database
    const LOTTERY_DATABASE = {"megasena": {"name": "Megasena"}, "lotofacil": {"name": "Lotofácil"}, "quina": {"name": "Quina"}, "lotomania": {"name": "Lotomania"}, "duplasena": {"name": "Duplasena"}, "timemania": {"name": "Timemania"}};

    // Active configurations
    let activeLottery = 'megasena';
    let activePage = 'dashboard';
    
    // PWA Install Prompt state
    let deferredPrompt = null;
    
    window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault();
      deferredPrompt = e;
      const installBtn = document.getElementById('pwa-install-nav');
      if (installBtn) {
        installBtn.style.display = 'flex';
      }
    });

    window.addEventListener('appinstalled', (evt) => {
      console.log('PWA instalado com sucesso!');
      const installBtn = document.getElementById('pwa-install-nav');
      if (installBtn) {
        installBtn.style.display = 'none';
      }
      deferredPrompt = null;
    });

    // Check if iOS and not standalone to show install instructions
    window.addEventListener('load', () => {
      const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
      const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;
      if (isIOS && !isStandalone) {
        const installBtn = document.getElementById('pwa-install-nav');
        if (installBtn) {
          installBtn.style.display = 'flex';
        }
      }
    });
    
    // User filters for generator (fixed/excluded sets)
    const fixedNumbers = new Set();
    const excludedNumbers = new Set();

    // Rule configurations
    const rules = {
      megasena: { max: 60, min: 6, maxSel: 20 },
      lotofacil: { max: 25, min: 15, maxSel: 20 },
      quina: { max: 80, min: 5, maxSel: 15 },
      lotomania: { max: 100, min: 50, maxSel: 50 },
      duplasena: { max: 50, min: 6, maxSel: 15 },
      timemania: { max: 80, min: 7, maxSel: 10 }
    };

    // Prices table for lotteries based on amount of selected numbers
    const BET_PRICES = {
      megasena: {
        6: 5.00, 7: 35.00, 8: 140.00, 9: 420.00, 10: 1050.00,
        11: 2310.00, 12: 4620.00, 13: 8580.00, 14: 15015.00, 15: 25025.00,
        16: 40040.00, 17: 61880.00, 18: 92820.00, 19: 135660.00, 20: 193800.00
      },
      lotofacil: {
        15: 3.00, 16: 48.00, 17: 408.00, 18: 2448.00, 19: 11628.00, 20: 46512.00
      },
      quina: {
        5: 2.50, 6: 15.00, 7: 52.50, 8: 140.00, 9: 315.00, 10: 630.00,
        11: 1155.00, 12: 1980.00, 13: 3217.50, 14: 5005.00, 15: 7507.50
      },
      duplasena: {
        6: 2.50, 7: 17.50, 8: 70.00, 9: 210.00, 10: 525.00, 11: 1155.00,
        12: 2310.00, 13: 4290.00, 14: 7507.50, 15: 12512.50
      },
      lotomania: {
        50: 3.00
      },
      timemania: {
        10: 3.50, 7: 3.50
      }
    };

    // Fechamento templates mapped by lottery
    const fechamentoTemplates = {
      megasena: [
        { name: "Mega-Sena - 9 Números -> Quadra Garantida", selectedCount: 9, ticketSize: 6, guarantee: 4, match: 4, costMultiplier: 12, desc: "Garante pelo menos 1 Quadra se 4 das 6 dezenas sorteadas estiverem entre suas 9 selecionadas. (Gera 12 Jogos)" },
        { name: "Mega-Sena - 8 Números -> Quina Garantida", selectedCount: 8, ticketSize: 6, guarantee: 5, match: 5, costMultiplier: 8, desc: "Garante pelo menos 1 Quina se 5 das 6 dezenas sorteadas estiverem entre suas 8 selecionadas. (Gera 8 Jogos)" },
        { name: "Mega-Sena - 10 Números -> Quadra Garantida", selectedCount: 10, ticketSize: 6, guarantee: 4, match: 4, costMultiplier: 30, desc: "Garante pelo menos 1 Quadra se 4 das 6 dezenas sorteadas estiverem entre suas 10 selecionadas. (Gera 30 Jogos)" }
      ],
      lotofacil: [
        { name: "Lotofácil - 18 Números -> 14 Pontos Garantidos", selectedCount: 18, ticketSize: 15, guarantee: 14, match: 15, costMultiplier: 24, desc: "Garante pelo menos 1 bilhete com 14 pontos se as 15 dezenas sorteadas estiverem entre suas 18 selecionadas. (Gera 24 Jogos)" },
        { name: "Lotofácil - 17 Números -> 14 Pontos Garantidos", selectedCount: 17, ticketSize: 15, guarantee: 14, match: 15, costMultiplier: 8, desc: "Garante pelo menos 1 bilhete com 14 pontos se as 15 dezenas sorteadas estiverem entre suas 17 selecionadas. (Gera 8 Jogos)" },
        { name: "Lotofácil - 19 Números -> 13 Pontos Garantidos", selectedCount: 19, ticketSize: 15, guarantee: 13, match: 15, costMultiplier: 14, desc: "Garante pelo menos 1 bilhete com 13 pontos se as 15 dezenas sorteadas estiverem entre suas 19 selecionadas. (Gera 14 Jogos)" },
        { name: "Lotofácil - 20 Números -> 13 Pontos Garantidos", selectedCount: 20, ticketSize: 15, guarantee: 13, match: 15, costMultiplier: 16, desc: "Garante pelo menos 1 bilhete com 13 pontos se as 15 dezenas sorteadas estiverem entre suas 20 selecionadas. (Gera 16 Jogos)" }
      ],
      quina: [
        { name: "Quina - 8 dezenas -> Quadra Garantida", selectedCount: 8, ticketSize: 5, guarantee: 4, match: 4, costMultiplier: 10, desc: "Garante pelo menos 1 Quadra se 4 das 5 dezenas sorteadas estiverem entre suas 8 selecionadas. (Gera 10 Jogos)" },
        { name: "Quina - 9 dezenas -> Quadra Garantida", selectedCount: 9, ticketSize: 5, guarantee: 4, match: 4, costMultiplier: 18, desc: "Garante pelo menos 1 Quadra se 4 das 5 dezenas sorteadas estiverem entre suas 9 selecionadas. (Gera 18 Jogos)" }
      ],
      duplasena: [
        { name: "Dupla Sena - 8 dezenas -> Quadra Garantida", selectedCount: 8, ticketSize: 6, guarantee: 4, match: 4, costMultiplier: 6, desc: "Garante pelo menos 1 Quadra se 4 das 6 dezenas sorteadas estiverem entre suas 8 selecionadas. (Gera 6 Jogos)" },
        { name: "Dupla Sena - 9 dezenas -> Quadra Garantida", selectedCount: 9, ticketSize: 6, guarantee: 4, match: 4, costMultiplier: 12, desc: "Garante pelo menos 1 Quadra se 4 das 6 dezenas sorteadas estiverem entre suas 9 selecionadas. (Gera 12 Jogos)" }
      ],
      timemania: [
        { name: "Timemania - 10 dezenas -> Quina Garantida", selectedCount: 10, ticketSize: 7, guarantee: 5, match: 5, costMultiplier: 14, desc: "Garante pelo menos 1 Quina (5 acertos) se 5 das 7 dezenas sorteadas estiverem entre suas 10 selecionadas. (Gera 14 Jogos)" }
      ]
    };

    function getSingleTicketCost(lottery, size) {
      const prices = BET_PRICES[lottery];
      if (!prices) return 0;
      
      if (lottery === 'lotomania') return 3.00;
      if (lottery === 'timemania') return 3.50;
      
      return prices[size] || prices[Object.keys(prices)[0]] || 0;
    }

    function toggleGeneratorMode() {
      const mode = document.getElementById('gen-mode').value;
      const statsFields = document.getElementById('gen-stats-fields');
      const fechamentoFields = document.getElementById('gen-fechamento-fields');
      const btnGen = document.getElementById('btn-generate-palpites');
      
      fixedNumbers.clear();
      excludedNumbers.clear();
      updateFilterCounters();

      if (mode === 'stats') {
        statsFields.style.display = 'flex';
        fechamentoFields.style.display = 'none';
        btnGen.innerText = "Gerar Jogos";
      } else {
        statsFields.style.display = 'none';
        fechamentoFields.style.display = 'flex';
        btnGen.innerText = "Gerar Fechamento";
        onSelectFechamentoTemplate();
      }
      renderTicketGrid();
    }

    function onSelectFechamentoTemplate() {
      const key = activeLottery;
      const templates = fechamentoTemplates[key] || [];
      const idx = parseInt(document.getElementById('gen-fechamento-template').value) || 0;
      const t = templates[idx];
      
      fixedNumbers.clear();
      excludedNumbers.clear();
      updateFilterCounters();

      const infoBox = document.getElementById('fechamento-info-box');
      if (t) {
        infoBox.innerHTML = `
          <p><b>Instruções:</b> Selecione exatamente <b>${t.selectedCount} dezenas</b> na cartela interativa ao lado.</p>
          <p style="margin-top: 6px; font-size: 11px; opacity: 0.85;">${t.desc}</p>
        `;
      } else {
        infoBox.innerHTML = "Selecione um template de fechamento.";
      }
      renderTicketGrid();
    }

    // Helper functions for combinations and greedy cover
    function getCombinations(array, k) {
      const result = [];
      function helper(start, combo) {
        if (combo.length === k) {
          result.push([...combo]);
          return;
        }
        for (let i = start; i < array.length; i++) {
          combo.push(array[i]);
          helper(i + 1, combo);
          combo.pop();
        }
      }
      helper(0, []);
      return result;
    }

    function solveCoveringDesign(pool, ticketSize, targetSize) {
      const targets = getCombinations(pool, targetSize);
      const candidates = getCombinations(pool, ticketSize);
      
      const targetCovered = new Array(targets.length).fill(false);
      let uncoveredCount = targets.length;
      const chosenTickets = [];
      
      const candidateCovers = candidates.map(c => {
        const coveredIndices = [];
        targets.forEach((t, tIdx) => {
          const isSubset = t.every(val => c.includes(val));
          if (isSubset) coveredIndices.push(tIdx);
        });
        return coveredIndices;
      });
      
      while (uncoveredCount > 0) {
        let bestCandidateIdx = -1;
        let maxNewCovered = -1;
        
        for (let i = 0; i < candidates.length; i++) {
          let count = 0;
          const covers = candidateCovers[i];
          for (let j = 0; j < covers.length; j++) {
            if (!targetCovered[covers[j]]) count++;
          }
          if (count > maxNewCovered) {
            maxNewCovered = count;
            bestCandidateIdx = i;
          }
        }
        
        if (bestCandidateIdx === -1 || maxNewCovered === 0) {
          break;
        }
        
        chosenTickets.push(candidates[bestCandidateIdx]);
        
        const covers = candidateCovers[bestCandidateIdx];
        for (let j = 0; j < covers.length; j++) {
          const idx = covers[j];
          if (!targetCovered[idx]) {
            targetCovered[idx] = true;
            uncoveredCount--;
          }
        }
      }
      return chosenTickets;
    }

    // Initialize Application
    window.addEventListener('DOMContentLoaded', () => {
      selectLottery('megasena');
      setupLogoLink();

      // Register Service Worker for PWA
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js')
          .then((reg) => console.log('Service Worker registrado com sucesso:', reg.scope))
          .catch((err) => console.error('Erro ao registrar Service Worker:', err));
      }
    });

    // Theme and Lottery Switcher
    async function selectLottery(key) {
      toggleMobileSidebar(false);
      if (!LOTTERY_DATABASE[key]) {
        console.error('Lottery not found in database:', key);
        return;
      }
      activeLottery = key;
      
      // Update body class for styles
      document.body.className = `theme-${key}`;
      
      // Update sidebar buttons active state
      document.querySelectorAll('.lottery-btn').forEach(btn => btn.classList.remove('active'));
      const activeBtn = document.getElementById(`btn-${key}`);
      if (activeBtn) activeBtn.classList.add('active');

      // Load statistics from server if not already cached in memory
      if (!LOTTERY_DATABASE[key].latest_draw) {
        showGlobalLoader(true);
        try {
          const response = await fetch(`api.php?action=get_stats&lottery=${key}`);
          if (!response.ok) throw new Error("Erro de conexão com a API.");
          const stats = await response.json();
          if (stats.error) throw new Error(stats.error);
          
          Object.assign(LOTTERY_DATABASE[key], stats);
        } catch (err) {
          console.error("Erro ao carregar estatísticas:", err);
          alert("Erro ao obter estatísticas da loteria. Por favor, tente novamente.");
          showGlobalLoader(false);
          return;
        }
        showGlobalLoader(false);
      }

      // Update header
      const data = LOTTERY_DATABASE[key];
      document.getElementById('lottery-header-name').innerHTML = `<span>${data.name}</span> Analisador`;
      document.getElementById('topbar-last-contest').innerText = data.latest_draw.contest;
      document.getElementById('topbar-last-date').innerText = data.latest_draw.date;
      document.getElementById('topbar-total-draws').innerText = data.total_draws;

      // Reset generator mode and cost display
      document.getElementById('gen-mode').value = 'stats';
      document.getElementById('gen-results-cost').style.display = 'none';
      toggleGeneratorMode();

      // Populate fechamento templates select for this lottery
      const ftSelect = document.getElementById('gen-fechamento-template');
      ftSelect.innerHTML = '';
      const templates = fechamentoTemplates[key] || [];
      templates.forEach((t, idx) => {
        const opt = document.createElement('option');
        opt.value = idx;
        opt.innerText = t.name;
        ftSelect.appendChild(opt);
      });
      const modeSelect = document.getElementById('gen-mode');
      if (templates.length === 0) {
        modeSelect.querySelector('option[value="fechamento"]').disabled = true;
      } else {
        modeSelect.querySelector('option[value="fechamento"]').disabled = false;
      }

      // Update simulator input label and placeholder dynamically
      const simLabel = document.getElementById('sim-input-label');
      const simInput = document.getElementById('sim-input');
      const r = rules[key];
      
      if (simLabel && simInput) {
        simLabel.innerHTML = `Dezenas do seu jogo (Mínimo: <b>${r.min} dezenas</b>)`;
        
        // Formulate a nice placeholder example based on active lottery
        let example = "";
        if (key === 'megasena') example = "Ex: 5, 12, 23, 34, 45, 56";
        else if (key === 'lotofacil') example = "Ex: 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15";
        else if (key === 'quina') example = "Ex: 10, 25, 41, 55, 78";
        else if (key === 'lotomania') example = "Ex: " + Array.from({length: 50}, (_, i) => i + 1).join(', ');
        else if (key === 'duplasena') example = "Ex: 2, 18, 21, 34, 41, 42";
        else if (key === 'timemania') example = "Ex: 13, 16, 36, 43, 51, 65, 66, 12, 23, 34";
        
        simInput.placeholder = example;
      }

      // Clear custom generation sets
      fixedNumbers.clear();
      excludedNumbers.clear();
      updateFilterCounters();

      // Refresh page contents
      renderDashboard();
      setupGeneratorForm();
      renderTicketGrid();
      renderStats();
      renderHistory();
      
      // Reset simulator
      document.getElementById('sim-input').value = '';
      document.getElementById('sim-results').style.display = 'none';

      const bolaoPanel = document.getElementById('page-bolao');
      if (bolaoPanel) {
        updateBolaoCalculations();
      }
    }

    // Tab Switcher
    function switchPage(pageId) {
      toggleMobileSidebar(false);
      activePage = pageId;
      document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
      
      // Find the clicked item by data map
      const mapping = { dashboard: 0, generator: 1, stats: 2, history: 3, bolao: 4 };
      if (pageId in mapping) {
        const items = Array.from(document.querySelectorAll('.nav-item'));
        items[mapping[pageId]].classList.add('active');
      }

      // Show/hide sections
      document.querySelectorAll('.page-view').forEach(view => view.classList.remove('active'));
      const targetPage = document.getElementById(`page-${pageId}`);
      if (targetPage) targetPage.classList.add('active');

      if (pageId === 'bolao') {
        updateBolaoCalculations();
      }
    }

    // Render Dashboard
    function renderDashboard() {
      const data = LOTTERY_DATABASE[activeLottery];
      const r = rules[activeLottery];
      
      // Title contest badge
      document.getElementById('dash-draw-badge').innerText = `Concurso ${data.latest_draw.contest}`;
      
      // Draw balls
      const container = document.getElementById('dash-draw-balls');
      container.innerHTML = '';
      data.latest_draw.numbers.forEach(num => {
        const ball = document.createElement('div');
        ball.className = `ball ball-${activeLottery}`;
        ball.innerText = String(num).padStart(2, '0');
        container.appendChild(ball);
      });

      // Split information
      const evenCount = data.latest_draw.numbers.filter(n => n % 2 === 0).length;
      const oddCount = data.latest_draw.numbers.length - evenCount;
      document.getElementById('dash-even-odd-split').innerText = `${oddCount} Ímpar${oddCount > 1 ? 'es' : ''} / ${evenCount} Par${evenCount > 1 ? 'es' : ''}`;

      const mid = r.max / 2;
      const highCount = data.latest_draw.numbers.filter(n => n > mid).length;
      const lowCount = data.latest_draw.numbers.length - highCount;
      document.getElementById('dash-high-low-split').innerText = `${lowCount} Baixo${lowCount > 1 ? 's' : ''} / ${highCount} Alto${highCount > 1 ? 's' : ''}`;

      const sum = data.latest_draw.numbers.reduce((a, b) => a + b, 0);
      const avgSum = data.avg_sum || 0;
      document.getElementById('dash-numbers-sum').innerText = `${sum} (Média: ${avgSum})`;

      // Top Hot/Cold Numbers
      document.getElementById('dash-hot-nums').innerText = data.hot_numbers.map(n => String(n).padStart(2,'0')).join(' - ');
      document.getElementById('dash-cold-nums').innerText = data.cold_numbers.map(n => String(n).padStart(2,'0')).join(' - ');

      document.getElementById('dash-high-pct').innerText = data.high_low_dist.high_pct + '%';
      document.getElementById('dash-low-pct').innerText = data.high_low_dist.low_pct + '%';

      // Suggested Smart Ticket
      generateNewSmartSuggestion();
    }

    // Generate Smart Suggested Game (Dashboard)
    function generateNewSmartSuggestion() {
      const data = LOTTERY_DATABASE[activeLottery];
      const r = rules[activeLottery];
      
      const suggested = getStatisticalGame(r.min, 'balanced');
      suggested.sort((a,b)=>a-b);

      const container = document.getElementById('smart-suggestion-balls');
      container.innerHTML = '';
      suggested.forEach(num => {
        const ball = document.createElement('div');
        ball.className = `ball ball-${activeLottery} highlighted`;
        ball.innerText = String(num).padStart(2, '0');
        container.appendChild(ball);
      });
      container.dataset.nums = suggested.join(',');
    }

    function sendSuggestionToGenerator() {
      const container = document.getElementById('smart-suggestion-balls');
      const nums = container.dataset.nums.split(',').map(Number);
      
      switchPage('generator');
      
      fixedNumbers.clear();
      nums.forEach(n => fixedNumbers.add(n));
      updateFilterCounters();
      renderTicketGrid();
      
      const genNumSelect = document.getElementById('gen-num-count');
      genNumSelect.value = nums.length;
      
      generateGames();
    }

    // Setup Generator configurations
    function setupGeneratorForm() {
      const r = rules[activeLottery];
      const select = document.getElementById('gen-num-count');
      select.innerHTML = '';
      
      // Populate allowed count of numbers (e.g. 6 to 15 or 15 to 20)
      for (let i = r.min; i <= r.maxSel; i++) {
        const opt = document.createElement('option');
        opt.value = i;
        opt.innerText = `${i} Dezenas`;
        select.appendChild(opt);
      }
      select.value = r.min;
      
      // Empty generated games container
      document.getElementById('generated-games-container').innerHTML = `
        <div style="text-align: center; padding: 48px 0; color: var(--text-muted); font-size: 13px;">
          Nenhum jogo gerado. Configure os parâmetros e clique em "Gerar Palpites".
        </div>
      `;
      document.getElementById('generator-actions').style.display = 'none';
      document.getElementById('gen-results-count').innerText = '0 Jogos';
    }

    function validateFormInput() {
      const selectCount = parseInt(document.getElementById('gen-num-count').value);
      if (fixedNumbers.size > selectCount) {
        alert(`Você selecionou ${fixedNumbers.size} números fixos, mas quer gerar um jogo com apenas ${selectCount} dezenas. Desmarque alguns números fixos.`);
        // Reset count selection or remove last fixed
        const arr = Array.from(fixedNumbers);
        while (fixedNumbers.size > selectCount) {
          fixedNumbers.delete(arr.pop());
        }
        updateFilterCounters();
        renderTicketGrid();
      }
    }

    // Interactive ticket drawing
    function renderTicketGrid() {
      const r = rules[activeLottery];
      const grid = document.getElementById('ticket-grid');
      grid.innerHTML = '';

      // Grid dimensions (adaptive columns based on max numbers)
      let cols = 10;
      if (activeLottery === 'lotofacil') cols = 5;
      else if (activeLottery === 'quina' || activeLottery === 'timemania') cols = 10;
      else if (activeLottery === 'lotomania') cols = 10;
      
      grid.style.gridTemplateColumns = `repeat(${cols}, 1fr)`;

      for (let i = 1; i <= r.max; i++) {
        const cell = document.createElement('div');
        cell.className = 'ticket-num';
        
        let displayVal = i;
        if (activeLottery === 'lotomania' && i === 100) displayVal = '00';
        cell.innerText = String(displayVal).padStart(2, '0');

        if (fixedNumbers.has(i)) cell.classList.add('fixed');
        if (excludedNumbers.has(i)) cell.classList.add('excluded');

        // Cycle through state on click
        cell.addEventListener('click', () => {
          const mode = document.getElementById('gen-mode').value;
          
          if (mode === 'fechamento') {
            const templates = fechamentoTemplates[activeLottery] || [];
            const idx = parseInt(document.getElementById('gen-fechamento-template').value) || 0;
            const t = templates[idx];
            
            if (fixedNumbers.has(i)) {
              fixedNumbers.delete(i);
            } else {
              if (t && fixedNumbers.size >= t.selectedCount) {
                alert(`Você já selecionou o limite de ${t.selectedCount} números para este fechamento.`);
              } else {
                fixedNumbers.add(i);
              }
            }
          } else {
            const selectCount = parseInt(document.getElementById('gen-num-count').value);
            if (fixedNumbers.has(i)) {
              fixedNumbers.delete(i);
              excludedNumbers.add(i);
            } else if (excludedNumbers.has(i)) {
              excludedNumbers.delete(i);
            } else {
              if (fixedNumbers.size >= selectCount) {
                alert(`Você já atingiu o limite de ${selectCount} números fixados.`);
                excludedNumbers.add(i);
              } else {
                fixedNumbers.add(i);
              }
            }
          }
          updateFilterCounters();
          renderTicketGrid();
        });

        grid.appendChild(cell);
      }
    }

    function updateFilterCounters() {
      const mode = document.getElementById('gen-mode').value;
      if (mode === 'fechamento') {
        const templates = fechamentoTemplates[activeLottery] || [];
        const idx = parseInt(document.getElementById('gen-fechamento-template').value) || 0;
        const t = templates[idx];
        const req = t ? t.selectedCount : 0;
        document.getElementById('count-fixed').innerText = `${fixedNumbers.size} de ${req} Selecionado${fixedNumbers.size !== 1 ? 's' : ''}`;
        document.getElementById('count-excluded').innerText = '';
      } else {
        document.getElementById('count-fixed').innerText = `${fixedNumbers.size} Fixado${fixedNumbers.size !== 1 ? 's' : ''}`;
        document.getElementById('count-excluded').innerText = `${excludedNumbers.size} Excluído${excludedNumbers.size !== 1 ? 's' : ''}`;
      }
    }

    function clearFilters() {
      fixedNumbers.clear();
      excludedNumbers.clear();
      updateFilterCounters();
      renderTicketGrid();
    }

    // Helper: Core Generation Logic with Statistical weights
    function getStatisticalGame(size, strategy) {
      const data = LOTTERY_DATABASE[activeLottery];
      const r = rules[activeLottery];

      // Pool definition
      const allNums = Array.from({ length: r.max }, (_, i) => i + 1);
      const allowedPool = allNums.filter(n => !excludedNumbers.has(n));
      
      // Extract fixed numbers that are in the allowed pool
      const game = Array.from(fixedNumbers).filter(n => allowedPool.includes(n));
      
      if (game.length >= size) return game.slice(0, size);

      // Simple Random
      if (strategy === 'random' || !data) {
        const remaining = allowedPool.filter(n => !game.includes(n));
        while (game.length < size && remaining.length > 0) {
          const idx = Math.floor(Math.random() * remaining.length);
          const n = remaining.splice(idx, 1)[0];
          game.push(n);
        }
        return game;
      }

      // Advanced Statistical Weighted Strategy
      const hotSet = new Set(data.hot_numbers);
      const coldSet = new Set(data.cold_numbers);

      if (strategy === 'hot') {
        const hotPool = allowedPool.filter(n => hotSet.has(n));
        const restPool = allowedPool.filter(n => !hotSet.has(n));
        
        while (game.length < size) {
          const pool = (Math.random() < 0.8 && hotPool.length > 0) ? hotPool : restPool;
          const unselected = pool.filter(n => !game.includes(n));
          const finalPool = unselected.length > 0 ? unselected : allowedPool.filter(n => !game.includes(n));
          
          if (finalPool.length === 0) break;
          const idx = Math.floor(Math.random() * finalPool.length);
          game.push(finalPool[idx]);
        }
      } 
      else if (strategy === 'cold') {
        const coldPool = allowedPool.filter(n => coldSet.has(n));
        const restPool = allowedPool.filter(n => !coldSet.has(n));
        
        while (game.length < size) {
          const pool = (Math.random() < 0.8 && coldPool.length > 0) ? coldPool : restPool;
          const unselected = pool.filter(n => !game.includes(n));
          const finalPool = unselected.length > 0 ? unselected : allowedPool.filter(n => !game.includes(n));
          
          if (finalPool.length === 0) break;
          const idx = Math.floor(Math.random() * finalPool.length);
          game.push(finalPool[idx]);
        }
      } 
      else { // Balanced
        const hotPool = allowedPool.filter(n => hotSet.has(n));
        const coldPool = allowedPool.filter(n => coldSet.has(n) && !hotSet.has(n));
        const neutralPool = allowedPool.filter(n => !hotSet.has(n) && !coldSet.has(n));

        while (game.length < size) {
          let pool;
          const rand = Math.random();
          
          if (rand < 0.60 && hotPool.length > 0) {
            pool = hotPool;
          } else if (rand < 0.80 && coldPool.length > 0) {
            pool = coldPool;
          } else {
            pool = neutralPool.length > 0 ? neutralPool : allowedPool;
          }
          
          const unselected = pool.filter(n => !game.includes(n));
          const finalPool = unselected.length > 0 ? unselected : allowedPool.filter(n => !game.includes(n));
          
          if (finalPool.length === 0) break;
          const idx = Math.floor(Math.random() * finalPool.length);
          game.push(finalPool[idx]);
        }
      }

      return game;
    }

    // Trigger Generator
    let lastGeneratedGames = [];
    
    function triggerGeneration() {
      const mode = document.getElementById('gen-mode').value;
      if (mode === 'fechamento') {
        generateFechamentoGames();
      } else {
        generateGames();
      }
    }

    async function generateFechamentoGames() {
      const templates = fechamentoTemplates[activeLottery] || [];
      const idx = parseInt(document.getElementById('gen-fechamento-template').value) || 0;
      const t = templates[idx];
      
      if (!t) {
        alert("Selecione um template de fechamento válido.");
        return;
      }
      
      if (fixedNumbers.size !== t.selectedCount) {
        alert(`Erro: Você selecionou ${fixedNumbers.size} dezenas, mas este fechamento exige exatamente ${t.selectedCount} dezenas.`);
        return;
      }

      showGlobalLoader(true);
      let generated = [];
      try {
        const response = await fetch('api.php?action=calculate_covering', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            lottery: activeLottery,
            pool: Array.from(fixedNumbers).sort((a,b)=>a-b),
            ticketSize: t.ticketSize,
            guarantee: t.guarantee
          })
        });
        if (!response.ok) throw new Error("Erro de comunicação com o servidor.");
        const res = await response.json();
        if (res.error) throw new Error(res.error);
        generated = res.games || [];
      } catch (err) {
        console.error("Erro no fechamento:", err);
        alert(err.message || "Erro ao gerar o fechamento.");
        showGlobalLoader(false);
        return;
      }
      showGlobalLoader(false);
      
      lastGeneratedGames = generated;
      
      const container = document.getElementById('generated-games-container');
      container.innerHTML = '';
      
      if (generated.length === 0) {
        container.innerHTML = `
          <div style="text-align: center; padding: 48px 0; color: var(--text-muted); font-size: 13px;">
            Erro ao gerar fechamento. Verifique se escolheu as dezenas corretas.
          </div>
        `;
        document.getElementById('generator-actions').style.display = 'none';
        document.getElementById('gen-results-count').innerText = '0 Jogos';
        document.getElementById('gen-results-cost').style.display = 'none';
        return;
      }

      document.getElementById('gen-results-count').innerText = `${generated.length} Jogo${generated.length !== 1 ? 's' : ''}`;
      
      // Cost calculation
      const ticketCost = getSingleTicketCost(activeLottery, t.ticketSize);
      const totalCost = ticketCost * generated.length;
      const costBadge = document.getElementById('gen-results-cost');
      costBadge.innerText = `Custo Total: R$ ${totalCost.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      costBadge.style.display = 'inline-block';

      document.getElementById('generator-actions').style.display = 'flex';

      generated.forEach((game, idx) => {
        const card = document.createElement('div');
        card.className = 'game-card';
        
        const info = document.createElement('div');
        info.className = 'game-num-info';
        
        const indexBadge = document.createElement('div');
        indexBadge.className = 'game-index';
        indexBadge.innerText = String(idx + 1).padStart(2, '0');
        info.appendChild(indexBadge);
        
        const ballsDiv = document.createElement('div');
        ballsDiv.className = 'game-balls';
        
        game.forEach(n => {
          const ball = document.createElement('div');
          ball.className = `ball ball-sm ball-${activeLottery}`;
          let displayVal = n;
          if (activeLottery === 'lotomania' && n === 100) displayVal = '00';
          ball.innerText = String(displayVal).padStart(2, '0');
          ballsDiv.appendChild(ball);
        });
        info.appendChild(ballsDiv);
        card.appendChild(info);

        const evenCount = game.filter(n => n % 2 === 0).length;
        const oddCount = game.length - evenCount;
        
        const r = rules[activeLottery];
        const mid = r.max / 2;
        const highCount = game.filter(n => n > mid).length;
        const lowCount = game.length - highCount;
        const sum = game.reduce((a,b)=>a+b, 0);

        const statsDiv = document.createElement('div');
        statsDiv.className = 'game-stats';
        statsDiv.innerHTML = `
          <span><b>P/I:</b> ${evenCount}P/${oddCount}I</span>
          <span><b>A/B:</b> ${highCount}A/${lowCount}B</span>
          <span><b>Soma:</b> ${sum}</span>
        `;
        card.appendChild(statsDiv);
        
        card.addEventListener('mouseenter', () => {
          document.querySelectorAll('.ticket-num').forEach((cell, cellIdx) => {
            const numVal = cellIdx + 1;
            if (game.includes(numVal)) {
              cell.classList.add('generated');
            }
          });
        });
        
        card.addEventListener('mouseleave', () => {
          document.querySelectorAll('.ticket-num').forEach(cell => {
            cell.classList.remove('generated');
          });
        });

        container.appendChild(card);
      });
    }

    async function generateGames() {
      const selectCount = parseInt(document.getElementById('gen-num-count').value);
      const ticketCount = parseInt(document.getElementById('gen-ticket-count').value);
      const strategy = document.getElementById('gen-strategy').value;

      if (ticketCount < 1 || ticketCount > 100) {
        alert("A quantidade de jogos deve ser entre 1 e 100.");
        return;
      }

      // Check if we have enough allowed numbers
      const r = rules[activeLottery];
      const allowedCount = r.max - excludedNumbers.size;
      if (allowedCount < selectCount) {
        alert(`Erro: Você tem apenas ${allowedCount} números disponíveis (excluindo os proibidos), mas solicitou jogos com ${selectCount} dezenas. Por favor, remova alguns números proibidos.`);
        return;
      }

      showGlobalLoader(true);
      let generated = [];
      try {
        const response = await fetch('api.php?action=generate_games', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            lottery: activeLottery,
            numCount: selectCount,
            gameCount: ticketCount,
            strategy: strategy,
            fixedNumbers: Array.from(fixedNumbers),
            excludedNumbers: Array.from(excludedNumbers)
          })
        });
        if (!response.ok) throw new Error("Erro de comunicação com o servidor.");
        const res = await response.json();
        if (res.error) throw new Error(res.error);
        generated = res.games || [];
      } catch (err) {
        console.error("Erro ao gerar palpites:", err);
        alert(err.message || "Erro ao gerar palpites.");
        showGlobalLoader(false);
        return;
      }
      showGlobalLoader(false);

      lastGeneratedGames = generated;
      
      // Update UI results
      const container = document.getElementById('generated-games-container');
      container.innerHTML = '';
      
      if (generated.length === 0) {
        container.innerHTML = `
          <div style="text-align: center; padding: 48px 0; color: var(--text-muted); font-size: 13px;">
            Falha ao gerar jogos. Tente desmarcar alguns filtros ou dezenas fixas.
          </div>
        `;
        document.getElementById('generator-actions').style.display = 'none';
        document.getElementById('gen-results-count').innerText = '0 Jogos';
        document.getElementById('gen-results-cost').style.display = 'none';
        return;
      }

      document.getElementById('gen-results-count').innerText = `${generated.length} Jogo${generated.length !== 1 ? 's' : ''}`;
      
      // Cost calculation
      const ticketCost = getSingleTicketCost(activeLottery, selectCount);
      const totalCost = ticketCost * generated.length;
      const costBadge = document.getElementById('gen-results-cost');
      costBadge.innerText = `Custo Total: R$ ${totalCost.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      costBadge.style.display = 'inline-block';

      document.getElementById('generator-actions').style.display = 'flex';

      generated.forEach((game, idx) => {
        const card = document.createElement('div');
        card.className = 'game-card';
        
        const info = document.createElement('div');
        info.className = 'game-num-info';
        
        const indexBadge = document.createElement('div');
        indexBadge.className = 'game-index';
        indexBadge.innerText = String(idx + 1).padStart(2, '0');
        info.appendChild(indexBadge);
        
        const ballsDiv = document.createElement('div');
        ballsDiv.className = 'game-balls';
        
        game.forEach(n => {
          const ball = document.createElement('div');
          ball.className = `ball ball-sm ball-${activeLottery}`;
          let displayVal = n;
          if (activeLottery === 'lotomania' && n === 100) displayVal = '00';
          ball.innerText = String(displayVal).padStart(2, '0');
          ballsDiv.appendChild(ball);
        });
        info.appendChild(ballsDiv);
        card.appendChild(info);

        // Stats summary for the single game
        const evenCount = game.filter(n => n % 2 === 0).length;
        const oddCount = game.length - evenCount;
        
        const mid = r.max / 2;
        const highCount = game.filter(n => n > mid).length;
        const lowCount = game.length - highCount;
        const sum = game.reduce((a,b)=>a+b, 0);

        const statsDiv = document.createElement('div');
        statsDiv.className = 'game-stats';
        statsDiv.innerHTML = `
          <span><b>P/I:</b> ${evenCount}P/${oddCount}I</span>
          <span><b>A/B:</b> ${highCount}A/${lowCount}B</span>
          <span><b>Soma:</b> ${sum}</span>
        `;
        card.appendChild(statsDiv);
        
        // Highlight numbers on ticket grid during hover
        card.addEventListener('mouseenter', () => {
          document.querySelectorAll('.ticket-num').forEach((cell, cellIdx) => {
            const numVal = cellIdx + 1;
            if (game.includes(numVal)) {
              cell.classList.add('generated');
            }
          });
        });
        
        card.addEventListener('mouseleave', () => {
          document.querySelectorAll('.ticket-num').forEach(cell => {
            cell.classList.remove('generated');
          });
        });

        container.appendChild(card);
      });
    }

    // Exporters
    function exportTXT() {
      if (lastGeneratedGames.length === 0) return;
      let out = `CENTRAL DAS LOTERIAS - PALPITES ${LOTTERY_DATABASE[activeLottery].name.toUpperCase()}\r\n`;
      out += `Data de Geração: ${new Date().toLocaleString()}\r\n\r\n`;
      
      lastGeneratedGames.forEach((game, idx) => {
        out += `Jogo ${String(idx + 1).padStart(2,'0')}: ${game.map(n => String(n === 100 && activeLottery === 'lotomania' ? '00' : n).padStart(2,'0')).join(' - ')}\r\n`;
      });
      
      const blob = new Blob([out], { type: 'text/plain;charset=utf-8' });
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = `jogos_${activeLottery}.txt`;
      a.click();
    }

    function exportCSV() {
      if (lastGeneratedGames.length === 0) return;
      let out = "Jogo;Dezenas\n";
      lastGeneratedGames.forEach((game, idx) => {
        out += `${idx + 1};${game.map(n => String(n === 100 && activeLottery === 'lotomania' ? '00' : n).padStart(2,'0')).join(';')}\n`;
      });
      
      const blob = new Blob([out], { type: 'text/csv;charset=utf-8' });
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = `jogos_${activeLottery}.csv`;
      a.click();
    }

    function checkGeneratedGames() {
      if (lastGeneratedGames.length === 0) return;
      const data = LOTTERY_DATABASE[activeLottery];
      
      let matchesReport = `<h3>Resultados de Teste de Histórico</h3><br/>`;
      let totalWinners = 0;
      
      // Let's check against all draw results
      // We don't have the full draws array in LOTTERY_DATABASE directly (only recent 15),
      // wait! We do have recent_draws, but wait! Does the JSON have all draws?
      // Let's check: recent_draws in stats_db has 15 draws.
      // Wait, we can test matches against the recent 15 draws, or see if we can perform a simulator check.
      // Let's display the results for the matches against recent draws, and tell the user about it.
      
      lastGeneratedGames.forEach((game, idx) => {
        let maxHits = 0;
        let maxContest = 0;
        
        // Simulating matching with recent draws
        data.recent_draws.forEach(draw => {
          const hits = game.filter(n => draw.numbers.includes(n)).length;
          if (hits > maxHits) {
            maxHits = hits;
            maxContest = draw.contest;
          }
        });
        
        matchesReport += `<p><b>Jogo ${idx+1}</b>: Máximo de <b>${maxHits} acertos</b> no recente Concurso ${maxContest}.</p>`;
      });
      
      alertModal("Análise de Concursos Recentes", matchesReport);
    }

    // PAGE 3: STATISTICS CHARTS
    function renderStats() {
      const data = LOTTERY_DATABASE[activeLottery];
      const r = rules[activeLottery];

      // Even/Odd distribution chart
      const chartContainer = document.getElementById('even-odd-chart');
      chartContainer.innerHTML = '';
      
      if (data.even_odd_dist) {
        const total = Object.values(data.even_odd_dist).reduce((a,b)=>a+b, 0);
        // Sort distributions by count
        const sortedDists = Object.entries(data.even_odd_dist).sort((a,b) => b[1] - a[1]);
        
        sortedDists.forEach(([pattern, count]) => {
          const pct = ((count / total) * 100).toFixed(1);
          
          const row = document.createElement('div');
          row.className = 'chart-row';
          
          const label = document.createElement('div');
          label.className = 'chart-label';
          label.innerText = pattern.replace('P', ' Pares').replace('I', ' Ímpares').replace(':', ' / ');
          row.appendChild(label);
          
          const barBg = document.createElement('div');
          barBg.className = 'chart-bar-bg';
          
          const barFill = document.createElement('div');
          barFill.className = 'chart-bar-fill';
          barFill.style.width = `${pct}%`;
          barBg.appendChild(barFill);
          row.appendChild(barBg);
          
          const val = document.createElement('div');
          val.className = 'chart-value';
          val.innerText = `${pct}%`;
          row.appendChild(val);
          
          chartContainer.appendChild(row);
        });
      }

      // High/Low percentage bar
      const highPct = data.high_low_dist.high_pct;
      const lowPct = data.high_low_dist.low_pct;
      document.getElementById('high-low-bar-low').style.width = `${lowPct}%`;
      document.getElementById('high-low-bar-high').style.width = `${highPct}%`;
      document.getElementById('low-pct-text').innerText = `${lowPct}%`;
      document.getElementById('high-pct-text').innerText = `${highPct}%`;

      // Quadrant distribution chart
      const quadChartContainer = document.getElementById('quadrant-chart');
      quadChartContainer.innerHTML = '';
      if (data.quadrant_dist) {
        Object.entries(data.quadrant_dist).forEach(([quad, pct]) => {
          const row = document.createElement('div');
          row.className = 'chart-row';
          
          const label = document.createElement('div');
          label.className = 'chart-label';
          label.innerText = `Quadrante ${quad}`;
          row.appendChild(label);
          
          const barBg = document.createElement('div');
          barBg.className = 'chart-bar-bg';
          
          const barFill = document.createElement('div');
          barFill.className = 'chart-bar-fill';
          barFill.style.width = `${pct}%`;
          barBg.appendChild(barFill);
          row.appendChild(barBg);
          
          const val = document.createElement('div');
          val.className = 'chart-value';
          val.innerText = `${pct}%`;
          row.appendChild(val);
          
          quadChartContainer.appendChild(row);
        });
      }

      // Prime numbers distribution chart
      const primeChartContainer = document.getElementById('prime-chart');
      primeChartContainer.innerHTML = '';
      if (data.prime_dist) {
        const total = Object.values(data.prime_dist).reduce((a,b)=>a+b, 0);
        const sortedPrimes = Object.entries(data.prime_dist).sort((a,b) => parseInt(a[0]) - parseInt(b[0]));
        
        sortedPrimes.forEach(([count, freqVal]) => {
          const pct = ((freqVal / total) * 100).toFixed(1);
          
          const row = document.createElement('div');
          row.className = 'chart-row';
          
          const label = document.createElement('div');
          label.className = 'chart-label';
          label.innerText = `${count} Primo${parseInt(count) !== 1 ? 's' : ''}`;
          row.appendChild(label);
          
          const barBg = document.createElement('div');
          barBg.className = 'chart-bar-bg';
          
          const barFill = document.createElement('div');
          barFill.className = 'chart-bar-fill';
          barFill.style.width = `${pct}%`;
          barBg.appendChild(barFill);
          row.appendChild(barBg);
          
          const val = document.createElement('div');
          val.className = 'chart-value';
          val.innerText = `${pct}%`;
          row.appendChild(val);
          
          primeChartContainer.appendChild(row);
        });
      }

      // Frequency Table
      buildStatsTable();
    }

    function buildStatsTable() {
      const data = LOTTERY_DATABASE[activeLottery];
      const r = rules[activeLottery];
      const tbody = document.getElementById('stats-table-body');
      tbody.innerHTML = '';

      const tableData = [];
      for (let i = 1; i <= r.max; i++) {
        const freq = data.frequency[String(i)] || 0;
        const pct = ((freq / data.total_draws) * 100).toFixed(1);
        const delay = data.delays[String(i)] !== undefined ? data.delays[String(i)] : data.total_draws;
        
        tableData.push({ num: i, freq, pct, delay });
      }

      // Store in memory for searches/sorts
      window.currentStatsTableData = tableData;
      displayStatsTableRows(tableData);
    }

    function displayStatsTableRows(dataRows) {
      const tbody = document.getElementById('stats-table-body');
      tbody.innerHTML = '';

      dataRows.forEach(row => {
        const tr = document.createElement('tr');
        
        let displayVal = row.num;
        if (activeLottery === 'lotomania' && row.num === 100) displayVal = '00';
        
        tr.innerHTML = `
          <td style="font-weight: 700; color: var(--accent-color);">${String(displayVal).padStart(2, '0')}</td>
          <td>${row.freq}</td>
          <td>${row.pct}%</td>
          <td style="color: ${row.delay > 15 ? '#ef4444' : 'var(--text-primary)'};">${row.delay}</td>
        `;
        tbody.appendChild(tr);
      });
    }

    function filterStatsTable() {
      const query = document.getElementById('stats-search').value.trim();
      if (!query) {
        displayStatsTableRows(window.currentStatsTableData);
        return;
      }
      
      const filtered = window.currentStatsTableData.filter(row => {
        let displayVal = String(row.num);
        if (activeLottery === 'lotomania' && row.num === 100) displayVal = '00';
        return displayVal.includes(query) || String(row.num).includes(query);
      });
      displayStatsTableRows(filtered);
    }

    // Sort table logic
    let lastSortCol = -1;
    let lastSortAsc = true;
    function sortTable(colIdx) {
      if (!window.currentStatsTableData) return;
      
      if (lastSortCol === colIdx) {
        lastSortAsc = !lastSortAsc;
      } else {
        lastSortCol = colIdx;
        lastSortAsc = true;
      }

      const multiplier = lastSortAsc ? 1 : -1;
      
      window.currentStatsTableData.sort((a, b) => {
        let valA, valB;
        if (colIdx === 0) { valA = a.num; valB = b.num; }
        else if (colIdx === 1) { valA = a.freq; valB = b.freq; }
        else if (colIdx === 2) { valA = parseFloat(a.pct); valB = parseFloat(b.pct); }
        else if (colIdx === 3) { valA = a.delay; valB = b.delay; }
        
        return (valA - valB) * multiplier;
      });

      // Update header indicator
      const headers = document.querySelectorAll('#stats-table th');
      headers.forEach((h, idx) => {
        let label = h.innerText.replace(' ▲', '').replace(' ▼', '').replace(' ⇅', '');
        if (idx === colIdx) {
          h.innerText = label + (lastSortAsc ? ' ▲' : ' ▼');
        } else {
          h.innerText = label + ' ⇅';
        }
      });

      filterStatsTable();
    }

    // PAGE 4: RESULTS HISTORY
    function renderHistory() {
      const data = LOTTERY_DATABASE[activeLottery];
      const container = document.getElementById('history-draws-container');
      container.innerHTML = '';

      // Loop recent draws (newest first)
      const reversedDraws = [...data.recent_draws].reverse();
      
      reversedDraws.forEach(draw => {
        const card = document.createElement('div');
        card.className = 'game-card';
        card.style.flexDirection = 'column';
        card.style.alignItems = 'flex-start';
        card.style.gap = '8px';
        
        const header = document.createElement('div');
        header.style.display = 'flex';
        header.style.justifyContent = 'space-between';
        header.style.width = '100%';
        header.style.fontSize = '12px';
        header.style.fontWeight = '600';
        
        header.innerHTML = `
          <span>Concurso <b style="color: var(--accent-color);">${draw.contest}</b></span>
          <span style="color: var(--text-muted);">${draw.date}</span>
        `;
        card.appendChild(header);

        const ballsDiv = document.createElement('div');
        ballsDiv.className = 'game-balls';
        draw.numbers.forEach(n => {
          const ball = document.createElement('div');
          ball.className = `ball ball-sm ball-${activeLottery}`;
          let displayVal = n;
          if (activeLottery === 'lotomania' && n === 100) displayVal = '00';
          ball.innerText = String(displayVal).padStart(2, '0');
          ballsDiv.appendChild(ball);
        });
        card.appendChild(ballsDiv);
        
        container.appendChild(card);
      });
    }

    // Simulated test for input game history
    function simulateGameHistory() {
      const inputStr = document.getElementById('sim-input').value;
      if (!inputStr) {
        alert("Por favor, digite as dezenas separadas por vírgula.");
        return;
      }
      
      const rawTokens = inputStr.split(',').map(x => x.trim()).filter(x => x !== '');
      const userNums = [];
      const invalidTokens = [];
      const outOfRangeNums = [];
      const r = rules[activeLottery];
      const maxVal = r.max;
      
      rawTokens.forEach(t => {
        const val = parseInt(t);
        if (isNaN(val)) {
          invalidTokens.push(t);
        } else if (val <= 0 || val > maxVal) {
          outOfRangeNums.push(val);
        } else {
          if (!userNums.includes(val)) {
            userNums.push(val);
          }
        }
      });

      if (invalidTokens.length > 0) {
        alert(`Erro: As seguintes dezenas não são números válidos: ${invalidTokens.join(', ')}`);
        return;
      }

      if (outOfRangeNums.length > 0) {
        alert(`Erro: Os números ${outOfRangeNums.join(', ')} são inválidos para a ${LOTTERY_DATABASE[activeLottery].name} (limite permitido: de 01 a ${maxVal}).`);
        return;
      }

      if (userNums.length < r.min) {
        alert(`Seu jogo precisa ter pelo menos ${r.min} números válidos para esta loteria. (Você possui apenas ${userNums.length} dezenas válidas no campo).`);
        return;
      }

      // Check hits in recent history (since we have recent_draws)
      const data = LOTTERY_DATABASE[activeLottery];
      const tbody = document.getElementById('sim-table-body');
      tbody.innerHTML = '';
      
      const hitBreakdown = {};
      let maxHits = 0;
      let matches = [];

      // We scan all recent draws (15 draws)
      data.recent_draws.forEach(draw => {
        const hits = userNums.filter(n => draw.numbers.includes(n));
        const hitCount = hits.length;
        
        if (hitCount > 0) {
          hitBreakdown[hitCount] = (hitBreakdown[hitCount] || 0) + 1;
          if (hitCount > maxHits) maxHits = hitCount;
          
          matches.push({
            contest: draw.contest,
            date: draw.date,
            hitCount: hitCount,
            hitNums: hits,
            drawNums: draw.numbers
          });
        }
      });

      // Sort matches (highest hits first)
      matches.sort((a, b) => b.hitCount - a.hitCount);

      // Display results
      document.getElementById('sim-results').style.display = 'flex';
      document.getElementById('sim-max-hits').innerText = `${maxHits} Acerto${maxHits !== 1 ? 's' : ''}`;

      const breakdownDiv = document.getElementById('sim-success-breakdown');
      breakdownDiv.innerHTML = '<span style="font-size:12px; color:var(--text-secondary); font-weight:600;">Resumo de Acertos nos 15 Concursos Recentes:</span>';
      
      const keys = Object.keys(hitBreakdown).sort((a,b)=>b-a);
      if (keys.length === 0) {
        breakdownDiv.innerHTML += `<div style="font-size:13px; color:var(--text-muted); margin-top:4px;">Nenhum acerto nos concursos recentes.</div>`;
      } else {
        keys.forEach(k => {
          breakdownDiv.innerHTML += `
            <div class="stat-row" style="padding: 6px 12px; font-size:12px;">
              <span>Jogos com <b>${k} acertos</b></span>
              <span>${hitBreakdown[k]} vez${hitBreakdown[k] !== 1 ? 'es' : ''}</span>
            </div>
          `;
        });
      }

      if (matches.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" style="text-align:center; color:var(--text-muted);">Nenhum acerto encontrado nos últimos 15 concursos.</td></tr>`;
      } else {
        matches.forEach(m => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>Concurso <b>${m.contest}</b></td>
            <td>${m.date}</td>
            <td style="font-weight:700; color: ${m.hitCount >= r.min - 2 ? 'var(--accent-color)' : 'var(--text-primary)'}">${m.hitCount} acertos</td>
            <td style="font-size:11px; color:var(--text-secondary);">${m.drawNums.map(n => {
              const strN = String(n === 100 && activeLottery === 'lotomania' ? '00' : n).padStart(2,'0');
              return m.hitNums.includes(n) ? `<b style="color:var(--accent-color);">${strN}</b>` : strN;
            }).join(' ')}</td>
          `;
          tbody.appendChild(tr);
        });
      }
    }

    // Modal Control
    function showDicasModal() {
      document.getElementById('dicas-modal').style.display = 'flex';
    }

    function closeDicasModal() {
      document.getElementById('dicas-modal').style.display = 'none';
    }

    function alertModal(title, bodyHtml) {
      const overlay = document.createElement('div');
      overlay.className = 'modal-overlay';
      overlay.style.display = 'flex';
      overlay.innerHTML = `
        <div class="modal">
          <div class="modal-header">
            ${title}
            <span class="modal-close" onclick="this.closest('.modal-overlay').remove()">&times;</span>
          </div>
          <div class="modal-body">
            ${bodyHtml}
          </div>
        </div>
      `;
      document.body.appendChild(overlay);
    }

    // --- BRAND LOGO CLICK HANDLER ---
    function setupLogoLink() {
      const logoLink = document.getElementById('logo-link');
      if (logoLink) {
        logoLink.addEventListener('click', function(e) {
          e.preventDefault();
          switchPage('dashboard');
        });
      }
    }

    async function triggerOnlineUpdate() {
      const pwd = prompt("Digite a chave de administrador para atualizar os resultados:");
      if (pwd === null) return;
      if (!pwd.trim()) {
        alert("A chave de administrador é obrigatória.");
        return;
      }
      
      const btn = document.getElementById('btn-update-results');
      if (btn) {
        btn.disabled = true;
        btn.innerHTML = `<div style="width: 12px; height: 12px; border: 2px solid rgba(255,255,255,0.1); border-top: 2px solid var(--accent-color); border-radius: 50%; animation: spin 1s linear infinite;"></div> Atualizando...`;
      }
      
      showGlobalLoader(true);
      
      try {
        const response = await fetch('api.php?action=update_results', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ password: pwd })
        });
        
        if (!response.ok) throw new Error("Erro de rede ao conectar à API do servidor.");
        const res = await response.json();
        
        if (res.error) throw new Error(res.error);
        
        if (res.success) {
          let updatedMsg = "Verificação de sorteios concluída.\n\nDetalhes:\n" + res.messages.join("\n");
          alert(updatedMsg);
          window.location.reload();
        } else {
          alert("Não foi possível processar a atualização.");
        }
      } catch (err) {
        console.error("Erro na atualização online:", err);
        alert(err.message || "Ocorreu um erro ao tentar atualizar os resultados.");
      } finally {
        showGlobalLoader(false);
        if (btn) {
          btn.disabled = false;
          btn.innerHTML = `
            <svg viewBox="0 0 24 24" style="width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>
            Atualizar Resultados
          `;
        }
      }
    }

    function showTutorialModal() {
      toggleMobileSidebar(false);
      document.getElementById('tutorial-modal').style.display = 'flex';
      switchTutorialTab('guia');
    }

    function closeTutorialModal() {
      document.getElementById('tutorial-modal').style.display = 'none';
    }

    function switchTutorialTab(tabId) {
      const btnGuia = document.getElementById('tab-btn-guia');
      const btnCiencia = document.getElementById('tab-btn-ciencia');
      const tabGuia = document.getElementById('tutorial-tab-guia');
      const tabCiencia = document.getElementById('tutorial-tab-ciencia');
      
      if (tabId === 'guia') {
        btnGuia.style.backgroundColor = 'var(--accent-color)';
        btnGuia.style.color = '#fff';
        btnGuia.style.borderColor = 'var(--accent-color)';
        
        btnCiencia.style.backgroundColor = 'transparent';
        btnCiencia.style.color = 'var(--text-secondary)';
        btnCiencia.style.borderColor = 'var(--border-color)';
        
        tabGuia.style.display = 'block';
        tabCiencia.style.display = 'none';
      } else {
        btnCiencia.style.backgroundColor = 'var(--accent-color)';
        btnCiencia.style.color = '#fff';
        btnCiencia.style.borderColor = 'var(--accent-color)';
        
        btnGuia.style.backgroundColor = 'transparent';
        btnGuia.style.color = 'var(--text-secondary)';
        btnGuia.style.borderColor = 'var(--border-color)';
        
        tabGuia.style.display = 'none';
        tabCiencia.style.display = 'block';
      }
    }

    function showGlobalLoader(show) {
      const loader = document.getElementById('global-loader');
      if (loader) {
        loader.style.display = show ? 'flex' : 'none';
      }
    }

    function toggleMobileSidebar(open) {
      const sidebar = document.querySelector('.sidebar');
      const overlay = document.getElementById('sidebar-overlay');
      if (sidebar && overlay) {
        if (open) {
          sidebar.classList.add('active');
          overlay.classList.add('active');
        } else {
          sidebar.classList.remove('active');
          overlay.classList.remove('active');
        }
      }
    }

    function triggerPwaInstall() {
      toggleMobileSidebar(false);
      const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
      const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;

      if (isIOS && !isStandalone) {
        alert("Para instalar este aplicativo no seu iPhone:\n\n1. Toque no botão de Compartilhar (ícone com quadrado e seta para cima na barra inferior do Safari).\n2. Role a lista e selecione 'Adicionar à Tela de Início'.\n3. Toque em 'Adicionar' no canto superior direito.");
        return;
      }

      if (!deferredPrompt) {
        alert("A instalação não está disponível no momento. Se você já instalou o app, ele pode ser aberto a partir da sua tela inicial.");
        return;
      }
      
      deferredPrompt.prompt();
      deferredPrompt.userChoice.then((choiceResult) => {
        if (choiceResult.outcome === 'accepted') {
          console.log('User accepted the install prompt');
          const installBtn = document.getElementById('pwa-install-nav');
          if (installBtn) installBtn.style.display = 'none';
        } else {
          console.log('User dismissed the install prompt');
        }
        deferredPrompt = null;
      });
    }

    function shareWhatsApp() {
      if (lastGeneratedGames.length === 0) return;
      const data = LOTTERY_DATABASE[activeLottery];
      let text = `✦ *Palpites Inteligentes: ${data.name}* ✦\n`;
      text += `_Gerado na Central das Loterias_\n\n`;
      
      lastGeneratedGames.forEach((game, idx) => {
        const gameStr = game.map(n => String(n === 100 && activeLottery === 'lotomania' ? '00' : n).padStart(2, '0')).join(' - ');
        text += `*Jogo ${String(idx + 1).padStart(2, '0')}*: [ ${gameStr} ]\n`;
      });
      
      text += `\n*Gere seus palpites:* https://4u.ia.br`;
      
      const encodedText = encodeURIComponent(text);
      const url = `https://api.whatsapp.com/send?text=${encodedText}`;
      window.open(url, '_blank');
    }

    function formatCurrencyInput(input) {
      let value = input.value.replace(/\D/g, '');
      if (value === '') {
        input.value = '';
        return;
      }
      let floatVal = parseFloat(value) / 100;
      input.value = floatVal.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateBolaoCalculations() {
      const gcInput = document.getElementById('bolao-game-count');
      const sInput = document.getElementById('bolao-shares');
      const fInput = document.getElementById('bolao-fee');
      const pInput = document.getElementById('bolao-estimated-prize');
      const customTotalInput = document.getElementById('bolao-custom-total');
      
      if (!gcInput || !sInput || !fInput || !pInput) return;

      const gameCount = parseInt(gcInput.value) || 1;
      const shares = parseInt(sInput.value) || 1;
      const feePct = parseFloat(fInput.value) || 0;
      
      const rawPrizeText = pInput.value;
      const cleanPrizeText = rawPrizeText.replace(/\./g, '').replace(',', '.');
      const estimatedPrize = parseFloat(cleanPrizeText) || 0;
      
      const rulesObj = rules[activeLottery];
      const singleCost = getSingleTicketCost(activeLottery, rulesObj.min);
      
      let officialCost = singleCost * gameCount;
      let usingCustom = false;
      
      if (customTotalInput && customTotalInput.value.trim() !== '') {
        const cleanCustomText = customTotalInput.value.replace(/\./g, '').replace(',', '.');
        const customVal = parseFloat(cleanCustomText);
        if (!isNaN(customVal) && customVal > 0) {
          officialCost = customVal;
          usingCustom = true;
        }
      }
      
      const finalUnitCost = usingCustom ? (officialCost / gameCount) : singleCost;
      const feeVal = officialCost * (feePct / 100);
      const totalCost = officialCost + feeVal;
      
      const shareCost = totalCost / shares;
      const sharePrize = estimatedPrize / shares;
      
      document.getElementById('bolao-res-unit-cost').innerText = `R$ ${finalUnitCost.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      document.getElementById('bolao-res-official-cost').innerText = `R$ ${officialCost.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      document.getElementById('bolao-res-fee-val').innerText = `R$ ${feeVal.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      document.getElementById('bolao-res-total-cost').innerText = `R$ ${totalCost.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      document.getElementById('bolao-res-share-cost').innerText = `R$ ${shareCost.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      document.getElementById('bolao-res-share-prize').innerText = `R$ ${sharePrize.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      
      const lotName = LOTTERY_DATABASE[activeLottery].name;
      document.getElementById('bolao-summary-text').innerHTML = `
        Este bolão de <b>${lotName}</b> é composto por <b>${shares} cotas</b>. 
        O custo dos bilhetes oficiais da Caixa é de <b>R$ ${officialCost.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</b>. 
        Foi aplicada uma taxa de organização de <b>${feePct}% (R$ ${feeVal.toLocaleString('pt-BR', { minimumFractionDigits: 2 })})</b> pelo serviço do organizador. 
        Se o bolão ganhar o prêmio principal acumulado de <b>R$ ${estimatedPrize.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</b>, cada participante receberá <b>R$ ${sharePrize.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</b> por cota.
      `;
    }


  </script>

  <!-- Global Loader -->
  <div id="global-loader" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(6, 9, 19, 0.85); backdrop-filter: blur(8px); display: none; align-items: center; justify-content: center; z-index: 99999; flex-direction: column; gap: 16px;">
    <div style="width: 40px; height: 40px; border: 3px solid rgba(255,255,255,0.1); border-top: 3px solid var(--accent-color); border-radius: 50%; animation: spin 1s linear infinite;"></div>
    <span style="font-size: 13px; color: var(--text-secondary); font-weight: 500;">Processando requisição...</span>
  </div>

    <script defer src="/assets/4ulabs-ecosystem.js?v=20261122" data-fouru-i18n="1"></script>
</body>
</html>
