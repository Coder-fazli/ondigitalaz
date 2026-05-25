(function () {
    var wrap = document.getElementById('od-seo-chart-wrap');
    if (!wrap) return;

    /* ── Data ─────────────────────────────────────────────── */
    var periods = {
        '3 Months': {
            dates:   ['Jan 1','Jan 15','Feb 1','Feb 15','Mar 1','Mar 15','Apr 1','Apr 15','May 1','May 15','Jun 1','Jun 15'],
            organic: [420, 480, 510, 560, 620, 700, 780, 870, 960, 1080, 1230, 1420],
            paid:    [180, 200, 215, 235, 255, 280, 300, 325, 345, 380, 415, 455],
            badge:   '+15%'
        },
        '30 Days': {
            dates:   ['Jun 1','Jun 3','Jun 5','Jun 7','Jun 9','Jun 12','Jun 15','Jun 18','Jun 21','Jun 24','Jun 27','Jun 30'],
            organic: [290, 270, 310, 280, 260, 350, 320, 340, 400, 370, 420, 480],
            paid:    [130, 120, 145, 135, 125, 165, 155, 160, 185, 175, 195, 225],
            badge:   '+12%'
        },
        '7 Days': {
            dates:   ['Jun 24','Jun 25','Jun 26','Jun 27','Jun 28','Jun 29','Jun 30'],
            organic: [370, 420, 380, 450, 480, 520, 550],
            paid:    [175, 200, 185, 210, 225, 245, 260],
            badge:   '+18%'
        }
    };

    var periodKeys   = Object.keys(periods);
    var activePeriod = periodKeys[0];

    /* ── SVG helpers ──────────────────────────────────────── */
    var NS  = 'http://www.w3.org/2000/svg';
    var W   = 800, H = 420, PAD = 55;

    function el(tag, attrs, styles) {
        var e = document.createElementNS(NS, tag);
        if (attrs) Object.keys(attrs).forEach(function(k) { e.setAttribute(k, attrs[k]); });
        if (styles) Object.keys(styles).forEach(function(k) { e.style[k] = styles[k]; });
        return e;
    }

    function maxOf(data) {
        return Math.max.apply(null, data.organic.concat(data.paid)) * 1.08;
    }

    function pointsFor(values, maxVal) {
        return values.map(function(v, i) {
            return {
                x: PAD + (i / (values.length - 1)) * (W - PAD * 2),
                y: PAD + (1 - v / maxVal) * (H - PAD * 2)
            };
        });
    }

    function buildPath(pts, isArea) {
        var d = 'M ' + pts[0].x + ',' + pts[0].y;
        for (var i = 1; i < pts.length; i++) {
            var prev = pts[i - 1], curr = pts[i], next = pts[i + 1];
            var cp1x = prev.x + (curr.x - prev.x) * 0.5, cp1y = prev.y;
            var cp2x = curr.x - (next ? (next.x - curr.x) * 0.3 : 0), cp2y = curr.y;
            d += ' C ' + cp1x + ',' + cp1y + ' ' + cp2x + ',' + cp2y + ' ' + curr.x + ',' + curr.y;
        }
        if (isArea) d += ' L ' + pts[pts.length-1].x + ',' + (H-PAD) + ' L ' + PAD + ',' + (H-PAD) + ' Z';
        return d;
    }

    /* ── Build shell HTML ─────────────────────────────────── */
    wrap.innerHTML = '';
    wrap.style.position = 'relative';

    /* Legend */
    var legend = document.createElement('div');
    legend.className = 'od-chart-legend';
    legend.innerHTML =
        '<span><em class="od-dot od-dot-green"></em>Organic Traffic</span>' +
        '<span><em class="od-dot od-dot-dark"></em>Paid Traffic</span>';
    legend.style.cssText = 'display:flex;gap:24px;margin-bottom:12px;opacity:0;transition:opacity 0.8s ease 0.4s;';
    wrap.appendChild(legend);

    /* Period buttons */
    var btnBar = document.createElement('div');
    btnBar.className = 'od-chart-periods';
    btnBar.style.cssText = 'position:absolute;top:0;right:0;display:flex;flex-direction:column;gap:8px;z-index:10;';

    periodKeys.forEach(function(key, idx) {
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'od-period-btn' + (key === activePeriod ? ' active' : '');
        btn.dataset.period = key;
        var colors = ['#22c55e','#3b82f6','#f97316'];
        btn.innerHTML =
            '<div class="od-btn-top"><em style="background:' + colors[idx] + '"></em><span class="od-btn-badge">' + periods[key].badge + '</span></div>' +
            '<div class="od-btn-label">' + key + '</div>';
        btn.style.cssText = 'opacity:0;transform:translateX(20px);transition:opacity 0.7s ease ' + (0.5 + idx * 0.15) + 's, transform 0.7s ease ' + (0.5 + idx * 0.15) + 's;';
        btnBar.appendChild(btn);
    });
    wrap.appendChild(btnBar);

    /* SVG container */
    var svgWrap = document.createElement('div');
    svgWrap.style.cssText = 'position:relative;width:100%;';
    wrap.appendChild(svgWrap);

    /* ── Build SVG ────────────────────────────────────────── */
    function buildSVG(data, animate) {
        svgWrap.innerHTML = '';
        var maxVal = maxOf(data);

        var svg = el('svg', { viewBox: '0 0 ' + W + ' ' + H }, { width: '100%', height: '100%', overflow: 'visible' });

        /* Defs — gradients */
        var defs = el('defs');

        var gGreen = el('linearGradient', { id: 'od-g1', x1: '0', y1: '0', x2: '0', y2: '1' });
        var gs1 = el('stop', { offset: '0%', 'stop-color': '#c2f971', 'stop-opacity': '0.35' });
        var gs2 = el('stop', { offset: '100%', 'stop-color': '#c2f971', 'stop-opacity': '0' });
        gGreen.appendChild(gs1); gGreen.appendChild(gs2);

        var gGray = el('linearGradient', { id: 'od-g2', x1: '0', y1: '0', x2: '0', y2: '1' });
        var gs3 = el('stop', { offset: '0%', 'stop-color': '#555', 'stop-opacity': '0.12' });
        var gs4 = el('stop', { offset: '100%', 'stop-color': '#555', 'stop-opacity': '0' });
        gGray.appendChild(gs3); gGray.appendChild(gs4);

        defs.appendChild(gGreen); defs.appendChild(gGray);
        svg.appendChild(defs);

        /* Grid */
        [0.25, 0.5, 0.75, 1].forEach(function(pct) {
            var y = PAD + (1 - pct) * (H - PAD * 2);
            svg.appendChild(el('line', { x1: PAD, y1: y, x2: W - PAD, y2: y, stroke: 'rgba(18,18,18,0.07)', 'stroke-width': '1', 'stroke-dasharray': '4,4' }));
            svg.appendChild(el('text', { x: PAD - 8, y: y + 4, 'text-anchor': 'end', fill: '#999', 'font-size': '11' },
                { opacity: animate ? '0' : '1', transition: animate ? 'opacity 0.5s ease 1.6s' : '' }
            )).textContent = Math.round(maxVal * pct);
        });

        var paidPts    = pointsFor(data.paid, maxVal);
        var organicPts = pointsFor(data.organic, maxVal);

        /* Paid area */
        var paidArea = el('path', { d: buildPath(paidPts, true), fill: 'url(#od-g2)' },
            animate ? { opacity: '0', transition: 'opacity 2s ease' } : { opacity: '1' });
        svg.appendChild(paidArea);

        /* Organic area */
        var orgArea = el('path', { d: buildPath(organicPts, true), fill: 'url(#od-g1)' },
            animate ? { opacity: '0', transition: 'opacity 2s ease 0.3s' } : { opacity: '1' });
        svg.appendChild(orgArea);

        /* Paid line */
        var paidLine = el('path', { d: buildPath(paidPts, false), fill: 'none', stroke: '#555555', 'stroke-width': '2', 'stroke-linecap': 'round' },
            animate ? { opacity: '0', strokeDasharray: '3000', strokeDashoffset: '3000', transition: 'opacity 0.5s ease 0.6s, stroke-dashoffset 2s ease 0.6s' }
                    : { opacity: '1' });
        svg.appendChild(paidLine);

        /* Organic line */
        var orgLine = el('path', { d: buildPath(organicPts, false), fill: 'none', stroke: '#c2f971', 'stroke-width': '2.5', 'stroke-linecap': 'round' },
            animate ? { opacity: '0', strokeDasharray: '3000', strokeDashoffset: '3000', transition: 'opacity 0.5s ease 0.9s, stroke-dashoffset 2s ease 0.9s' }
                    : { opacity: '1' });
        svg.appendChild(orgLine);

        /* Tooltip group (rendered last = on top) */
        var tip = el('g'); tip.style.display = 'none';
        var tipRect = el('rect', { width: '120', height: '68', rx: '6', fill: '#121212' });
        var tipDate = el('text', { x: '60', y: '18', 'text-anchor': 'middle', fill: '#fff', 'font-size': '11', 'font-weight': '600' });
        var tipOrg  = el('text', { x: '60', y: '36', 'text-anchor': 'middle', fill: '#c2f971', 'font-size': '10' });
        var tipPaid = el('text', { x: '60', y: '52', 'text-anchor': 'middle', fill: '#999', 'font-size': '10' });
        tip.appendChild(tipRect); tip.appendChild(tipDate); tip.appendChild(tipOrg); tip.appendChild(tipPaid);
        svg.appendChild(tip);

        /* Points + hit areas */
        var dotPairs = []; // [{oc, pc, ox, oy, px, py}] — stored for RAF animation

        data.dates.forEach(function(date, i) {
            var op = organicPts[i], pp = paidPts[i];

            var oc = el('circle', { cx: op.x, cy: op.y, r: animate ? '0' : '4', fill: '#c2f971', stroke: '#fff', 'stroke-width': '1.5' },
                animate ? { opacity: '0' } : { opacity: '1' });

            var pc = el('circle', { cx: pp.x, cy: pp.y, r: animate ? '0' : '4', fill: '#555555', stroke: '#fff', 'stroke-width': '1.5' },
                animate ? { opacity: '0' } : { opacity: '1' });

            svg.appendChild(oc); svg.appendChild(pc);
            dotPairs.push({ oc: oc, pc: pc, ox: op.x, oy: op.y, px: pp.x, py: pp.y });

            /* Hit zone */
            var hit = el('rect', { x: op.x - 20, y: PAD, width: '40', height: H - PAD * 2, fill: 'transparent' });
            hit.style.cursor = 'crosshair';
            hit.addEventListener('mouseenter', function() {
                oc.setAttribute('r', '6'); pc.setAttribute('r', '6');
                var tx = Math.min(Math.max(op.x - 60, PAD), W - PAD - 120);
                tip.setAttribute('transform', 'translate(' + tx + ',16)');
                tipDate.textContent = date;
                tipOrg.textContent  = 'Organic: ' + data.organic[i];
                tipPaid.textContent = 'Paid: ' + data.paid[i];
                tip.style.display = '';
            });
            hit.addEventListener('mouseleave', function() {
                oc.setAttribute('r', '4'); pc.setAttribute('r', '4');
                tip.style.display = 'none';
            });
            svg.appendChild(hit);

            /* X label */
            var lbl = el('text', { x: op.x, y: H - PAD + 18, 'text-anchor': 'middle', fill: '#999', 'font-size': '11' },
                animate ? { opacity: '0', transition: 'opacity 0.4s ease ' + (1.5 + i * 0.08) + 's' } : { opacity: '1' });
            lbl.textContent = date;
            svg.appendChild(lbl);
        });

        svgWrap.appendChild(svg);

        /* Fire animation */
        if (animate) {
            requestAnimationFrame(function() { requestAnimationFrame(function() {
                /* Lines + areas via CSS transition */
                paidArea.style.opacity  = '1';
                orgArea.style.opacity   = '1';
                paidLine.style.opacity  = '1'; paidLine.style.strokeDashoffset = '0';
                orgLine.style.opacity   = '1'; orgLine.style.strokeDashoffset  = '0';

                /* X labels */
                svg.querySelectorAll('text').forEach(function(t) { t.style.opacity = '1'; });

                /* Dots — RAF-driven: fly from left, grow r 0→4 */
                var FLY_OFFSET = 40;   // px to the left of final position
                var DOT_DUR    = 450;  // ms per dot animation
                var STAGGER    = 100;  // ms between each dot
                var BASE_DELAY = 1200; // ms after animation fires

                function easeOutBack(t) {
                    var c1 = 1.70158, c3 = c1 + 1;
                    return 1 + c3 * Math.pow(t - 1, 3) + c1 * Math.pow(t - 1, 2);
                }

                dotPairs.forEach(function(pair, i) {
                    var startDelay = BASE_DELAY + i * STAGGER;

                    function animatePair(circle, finalCx, finalCy) {
                        setTimeout(function() {
                            circle.style.opacity = '1';
                            var startTs = null;
                            function step(ts) {
                                if (!startTs) startTs = ts;
                                var prog = Math.min((ts - startTs) / DOT_DUR, 1);
                                var ease = easeOutBack(prog);
                                circle.setAttribute('cx', finalCx - FLY_OFFSET + FLY_OFFSET * ease);
                                circle.setAttribute('cy', finalCy);
                                circle.setAttribute('r',  4 * Math.min(prog * 2, 1)); // r grows in first half
                                if (prog < 1) requestAnimationFrame(step);
                                else { circle.setAttribute('cx', finalCx); circle.setAttribute('r', '4'); }
                            }
                            requestAnimationFrame(step);
                        }, startDelay);
                    }

                    animatePair(pair.oc, pair.ox, pair.oy);
                    animatePair(pair.pc, pair.px, pair.py);
                });
            }); });
        }
    }

    /* ── Period switch ────────────────────────────────────── */
    btnBar.addEventListener('click', function(e) {
        var btn = e.target.closest('.od-period-btn');
        if (!btn) return;
        activePeriod = btn.dataset.period;
        btnBar.querySelectorAll('.od-period-btn').forEach(function(b) {
            b.classList.toggle('active', b.dataset.period === activePeriod);
        });
        buildSVG(periods[activePeriod], false);
    });

    /* ── First render — animate on scroll into view ───────── */
    var animated = false;

    function runEntrance() {
        if (animated) return;
        animated = true;

        /* Phase 1 — legend */
        setTimeout(function() { legend.style.opacity = '1'; }, 100);

        /* Phase 2 — period buttons */
        setTimeout(function() {
            btnBar.querySelectorAll('.od-period-btn').forEach(function(b) {
                b.style.opacity   = '1';
                b.style.transform = 'translateX(0)';
            });
        }, 400);

        /* Phase 3 — chart */
        setTimeout(function() { buildSVG(periods[activePeriod], true); }, 600);
    }

    if ('IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function(entries) {
            if (entries[0].isIntersecting) { runEntrance(); obs.disconnect(); }
        }, { threshold: 0.25 });
        obs.observe(wrap);
    } else {
        runEntrance();
    }

})();
