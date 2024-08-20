<?php require_once 'Components/header.php' ?>


<style>
    /* Reset default browser styles */
body, h1, h2, p {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333;
}

header {
    background: #333;
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    margin: 0;
}

.sla-section {
    background: #fff;
    padding: 20px;
    margin: 20px 0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.sla-section img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    display: block;
    margin: 0 auto 20px;
}

footer {
    background: wheat;
    color: #fff;
    padding: 20px;
    text-align: center;
    margin-top: 20px;
}

footer p {
    margin: 10px;
}

.btn-container {
        text-align: center;
        margin: 20px 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sla-section {
        padding: 15px;
    }

    header, footer {
        padding: 15px 0;
    }
    h2{
        font-size: 32px;
    }
}

</style>

<body>
    <header>
        <h1>Service Level Agreement (SLA)</h1>
    </header>

    <section class="sla-section">
        <div class="container">
            <h2>1. System Availability</h2>
            <p><strong>Target:</strong> 99.9% uptime</p>
            <p><strong>Measurement Period:</strong> Monthly</p>
            <p><strong>Allowed Deviation:</strong> 0.1%</p>
            <p><strong>Penalty:</strong> 5% of monthly fee for every 0.1% below target, up to a maximum of 50% of the monthly fee</p>
        </div>
    </section>

    <section class="sla-section">
        <div class="container">
            <h2>2. Page Load Time</h2>
            <p><strong>Target:</strong></p>
            <ul>
                <li>Home Page: &lt; 2 seconds</li>
                <li>Reports Page: &lt; 3 seconds</li>
            </ul>
            <p><strong>Measurement:</strong> 95th percentile of load times</p>
            <p><strong>Measurement Period:</strong> Weekly</p>
            <p><strong>Allowed Deviation:</strong> 0.5 seconds</p>
            <p><strong>Penalty:</strong> 2% of weekly fee for every 0.5 seconds above target, up to a maximum of 20% of the weekly fee</p>
        </div>
    </section>

    <section class="sla-section">
        <div class="container">
            <h2>3. Data Accuracy</h2>
            <p><strong>Target:</strong> 99.99% accuracy for inventory data</p>
            <p><strong>Measurement Period:</strong> Monthly</p>
            <p><strong>Allowed Deviation:</strong> 0.01%</p>
            <p><strong>Penalty:</strong> 10% of monthly fee for every 0.01% below target, up to a maximum of 50% of the monthly fee</p>
        </div>
    </section>

    <section class="sla-section">
        <div class="container">
            <h2>4. Report Generation Time</h2>
            <p><strong>Target:</strong> &lt; 30 seconds for standard reports</p>
            <p><strong>Measurement:</strong> 90th percentile of generation times</p>
            <p><strong>Measurement Period:</strong> Weekly</p>
            <p><strong>Allowed Deviation:</strong> 5 seconds</p>
            <p><strong>Penalty:</strong> 5% of weekly fee for every 5 seconds above target, up to a maximum of 25% of the weekly fee</p>
        </div>
    </section>

    <section class="sla-section">
        <div class="container">
            <h2>5. Customer Support Response Time</h2>
            <p><strong>Target:</strong> &lt; 4 hours for critical issues</p>
            <p><strong>Measurement Period:</strong> Monthly</p>
            <p><strong>Allowed Deviation:</strong> 1 hour</p>
            <p><strong>Penalty:</strong> 5% of monthly fee for every hour above target, up to a maximum of 25% of the monthly fee</p>
        </div>
    </section>

    <section class="sla-section">
        <div class="container">
            <h2>6. System Update Downtime</h2>
            <p><strong>Target:</strong> &lt; 2 hours per month for scheduled maintenance</p>
            <p><strong>Measurement Period:</strong> Monthly</p>
            <p><strong>Allowed Deviation:</strong> 30 minutes</p>
            <p><strong>Penalty:</strong> 5% of monthly fee for every 30 minutes above target, up to a maximum of 20% of the monthly fee</p>
        </div>
    </section>


    <div class="btn-container"><a class="btn btn-outline-primary"" href="index.php"> Back</a></div>
    

    <footer>
        <p>Note: All penalties are cumulative across different metrics but capped at 75% of the total monthly fee.</p>
        <p>Reporting: Performance reports against these SLAs will be provided monthly, with weekly breakdowns where applicable.</p>
        <p>Review: This SLA will be reviewed quarterly and may be adjusted based on system performance and business needs.</p>
    </footer>
</body>
</html>
