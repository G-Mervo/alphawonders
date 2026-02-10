<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedBlogPosts extends Migration
{
    public function up()
    {
        $builder = $this->db->table('blog');

        // Only seed if the table is empty
        if ($builder->countAllResults(false) > 0) {
            return;
        }

        $posts = [
            [
                'blog_author' => 'Mervin Gaitho',
                'blog_title' => 'Introduction to Quantum Computers',
                'blog_url' => 'introduction-to-quantum-computers',
                'blog_image' => 'assets/img/qtmcomp.jpg',
                'blog_category' => 'quantum-computing',
                'blog_id' => 1,
                'blog_description' => '<p class="lead">Quantum Computers are now being produced for commercial and personal usage. This will see the rate of invention and information processing rapidly increase. Their specifications are just amazing and since we all love faster smarter machines then why not go for them!</p>

<h4>1. Introduction</h4>
<p>The computing ecosystem has always had deep impacts on society and technology and profoundly changed our lives in myriads of ways. Despite decades of impressive Moore\'s Law performance scaling and other growth in the computing ecosystem there are nonetheless still important potential applications of computing that remain out of reach of current or foreseeable conventional computer systems.</p>

<h5>Why Quantum Computing?</h5>
<p>Quantum computing (QC) is viewed by many as a possible future option for tackling these high-complexity or seemingly-intractable problems by complementing classical computing with a fundamentally different compute paradigm. Classically-intractable problems include chemistry and molecular dynamics simulations to support the design of better ways to understand and design chemical reactions, ranging from nitrogen fixation as the basis for fertilizer production, to the design of pharmaceuticals.</p>

<h5>What is Quantum Computing?</h5>
<p>QC uses quantum mechanical properties to express and manipulate information as quantum bits or qubits. Through specific properties from quantum physics, a quantum computer can operate on an exponentially large computational space at a cost that scales only polynomially with the required resources. Algorithms that can be appropriately implemented on a quantum computer can offer large potential speedups — sometimes even exponential speedups — over the best current classical approaches.</p>

<h5>The Inflection Point: Why now?</h5>
<p>The intellectual roots of QC go back decades to pioneers such as Richard Feynman who considered the fundamental difficulty of simulating quantum systems and "turned the problem around" by proposing to use quantum mechanics itself as a basis for implementing a new kind of computer capable of solving such problems. Although the basic theoretical underpinning of QC has been around for some time, it took until the past 5 years to bring the field to an inflection point: now small and intermediate-scale machines are being built in various labs, in academia and industry.</p>',
                'date_created' => '2019-09-02 21:00:00',
            ],
            [
                'blog_author' => 'Mervin Gaitho',
                'blog_title' => 'Data Science: Building a Career in Data Analytics',
                'blog_url' => 'data-science-building-a-career-in-data-analytics',
                'blog_image' => 'assets/img/datasci.jpg',
                'blog_category' => 'data-science',
                'blog_id' => 2,
                'blog_description' => '<p class="lead">Data Science has brought a revolution in the way data is being handled, collected, recorded, analysed and presented. This has led to many contrasting views and change of policies by many Companies. This is what you need to know about majority of the policies and about the so-called \'partners\'. So, what really is data? And what about the fuzz around data science?</p>

<h4>1. Introduction</h4>
<p>Data science is a multi-disciplinary field that uses scientific methods, processes, algorithms and systems to extract knowledge and insights from structured and unstructured data. Data science is the same concept as data mining and big data: "use the most powerful hardware, the most powerful programming systems, and the most efficient algorithms to solve problems".</p>

<p>Data science is a "concept to unify statistics, data analysis, machine learning and their related methods" in order to "understand and analyze actual phenomena" with data. It employs techniques and theories drawn from many fields within the context of mathematics, statistics, computer science, and information science.</p>

<blockquote>Big data is like teenage sex: everyone talks about it, nobody really knows how to do it, everyone thinks everyone else is doing it, so everyone claims they are doing it... — Dan Ariely</blockquote>

<p>This quote is so apt. Many junior data scientists I know (this includes myself) wanted to get into data science because it was all about solving complex problems with cool new machine learning algorithms that make huge impact on a business. However, you may still need to readjust your expectations of what to expect from a data science role.</p>',
                'date_created' => '2019-08-15 21:00:00',
            ],
            [
                'blog_author' => 'Mervin Gaitho',
                'blog_title' => 'What is Robotics',
                'blog_url' => 'what-is-robotics',
                'blog_image' => 'assets/img/robotics.jpg',
                'blog_category' => 'robotics',
                'blog_id' => 3,
                'blog_description' => '<p class="lead">Robotics deals with the design, construction, operation, and use of robots, as well as computer systems for their control, sensory feedback, and information processing. These technologies are used to develop machines that can substitute for humans and replicate human actions.</p>

<h4>1. Introduction</h4>
<p>Robotics is an interdisciplinary branch of engineering and science that includes mechanical engineering, electronic engineering, information engineering, computer science, and others. Robotics deals with the design, construction, operation, and use of robots, as well as computer systems for their control, sensory feedback, and information processing.</p>

<p>These technologies are used to develop machines that can substitute for humans and replicate human actions. Robots can be used in many situations and for lots of purposes, but today many are used in dangerous environments (including inspection of radioactive materials, bomb detection and deactivation), manufacturing processes, or where humans cannot survive (e.g. in space, under water, in high heat, and clean up and containment of hazardous materials and radiation).</p>

<p>Robots can take on any form but some are made to resemble humans in appearance. This is said to help in the acceptance of a robot in certain replicative behaviors usually performed by people. Such robots attempt to replicate walking, lifting, speech, cognition, or any other human activity.</p>',
                'date_created' => '2019-08-29 21:00:00',
            ],
        ];

        $builder->insertBatch($posts);
    }

    public function down()
    {
        $this->db->table('blog')
                  ->whereIn('blog_url', [
                      'introduction-to-quantum-computers',
                      'data-science-building-a-career-in-data-analytics',
                      'what-is-robotics',
                  ])
                  ->delete();
    }
}
