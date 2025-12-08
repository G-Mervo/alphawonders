<?php defined('BASEPATH') OR exit('No direct script access Allowed'); ?>

<section class="alph-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1>Quantum Computing</h1>

                <p class=""> by <a href="#">Mervin </a><span class="glyphicon glyphicon-time"></span> Posted on September 2, 2019 at 9:00 PM</p>
                <hr>
                <img class="img-responsive" src="assets/img/qtmcomp.jpg" alt="Quantum Computing" style="width:800px; height: 200px;">

                <hr>
                <p class="lead">Quantum Computers are now being produced for commercial and personal usage. This will see the rate of invention and information processing rapidly increase. Their specifications are just amazing and since we all love faster smarter machines then why not go for them!</p>
                <h4>1. Introduction </h4>
            	<p>The computing ecosystem has always had deep impacts on society and technology and profoundly changed our lives in myriads of ways. Despite decades of impressive Moore’s Law performance scaling and other growth in the computing ecosystem there are nonetheless still important potential applications of computing that remain out of reach of current or foreseeable conventional computer systems. Specifically, there are computational applications whose complexity scales super-linearly, even exponentially, with the size of their input data such that the computation time or memory requirements for these problems become intractably large to solve for useful data input sizes. Such problems can have memory requirements that exceed what can be built on the most powerful supercomputers, and/or runtimes on the order of tens of years or more. </p>
            	<h5>Why Quantum Computing? </h5> 
            	<p>Quantum computing (QC) is viewed by many as a possible future option for tackling these high-complexity  or  seemingly-intractable  problems  by  complementing  classical  computing  with  a  fundamentally  different  compute  paradigm. Classically-intractable problems include chemistry and molecular dynamics simulations to support the design of better ways to understand and design chemical reactions, ranging from nitrogen fixation1 as the basis for fertilizer production, to the design of pharmaceuticals2,3. Materials science problems that can be tackled by QCs include finding compounds for better solar cells,  more  efficient  batteries,  and  new  kinds  of  power  lines  that  can  transmit  energy  losslessly4.  Finally,  Shor’s  algorithm5, which harnesses QC approaches to efficiently factor large numbers, raises the possibility of making vulnerable the current data encryption  systems  that  rely  on  the  intractability  of  this  calculation;  the  existence  of  a  QC  sufficiently  large  and  sufficiently  reliable to run Shor’s on full-length keys could make current cryptosystems vulnerable to attack and eavesdropping. </p>
            	<h5>What is Quantum Computing? </h5>
            	<p>QC uses quantum mechanical properties to express and manipulate information as quantum bits or qubits. Through specific properties from quantum physics, a quantum computer can operate on an exponentially large computational space at a cost that scales only polynomially with the required resources. Algorithms that can be appropriately implemented on a quantum computer can offer large potential speedups — sometimes even exponential speedups — over the best current classical approaches. QC therefore has the potential for speedups that are large enough to make previously-intractable problems tractable. For instance, on a classical computer, it would take quadrillions of years to find the ground state energy of a large molecular complex to high precision or to crack the encryption that secures internet traffic and bitcoin wallets. On a quantum computer, depending on the clock-speed of the device, these problems can potentially be solved in a few minutes or even seconds. </p>
            	<h5>The Inflection Point: Why now? </h5>
            	<p> The intellectual roots of QC go back decades to pioneers such as Richard Feynman who considered the fundamental difficulty of simulating quantum systems and “turned the problem around” by proposing to use quantum mechanics itself as a basis for implementing a new kind of computer capable of solving such problems . Although the basic theoretical underpinning of QC has been around for some time, it took until the past 5 years to bring the field to an inflection point: now small and intermediate-scale machines are being built in various labs, in academia and industry7 8. Preskill has coined9 the phrase Noisy Intermediate-Scale Quantum (NISQ) to refer to the class of machines we are building currently and for the foreseeable future, with 20-1000 qubits and  insufficient  resources  to  perform  error  correction10.  Increasingly,  substantial  research  and  development  investments  at  a  global scale seek to bring large NISQ and beyond quantum computers to fruition, and to develop novel quantum applications to run on them. </p>

                <hr>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="<?php echo base_url('/post-comments'); ?>" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comm-sct"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="img-responsive media-object" src="assets/icon/awlogo.png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Quantum Computing
                            <small>September 2, 2019 at 16:30 PM</small>
                        </h4>
                        Good read.
                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="/">Software World</a></li>
								<li><a href="/">Systems</a></li>
								<li><a href="/">Applications</a></li>
								<li><a href="/">Digital Marketing</a></li>
								<li><a href="/">Data Analytics</a></li>
								<li><a href="/">Cyber Security</a></li>
								<li><a href="/">Data Science</a></li>
								<li><a href="/">Blockchain Technology</a></li>
								<li><a href="/">Internet of Things</a></li>
								<li><a href="/">Machine Learning</a></li>
								<li><a href="/">Artificial Intelligence</a></li>
								<li><a href="/">Robotics</a></li>
								<li><a href="/">Quantum Computing</a></li>
								<li><a href="/">Control Theory</a></li>
								<li><a href="/">Mathematics</a></li>
								<li><a href="/">Business</a></li>
								<li><a href="/">Trends in Technology</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>

        <hr>
    </div>
</section>


